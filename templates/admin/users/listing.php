<?php 
  include 'templates/admin/layouts/header.php';
?>

<div class="flex grow">
  
  <?php include 'templates/admin/layouts/sidebar.php'; ?>

   <div class="wrapper flex grow flex-col">

    <?php include 'templates/admin/layouts/navbar.php'; ?>

    <main class="grow content pt-5" id="content" role="content">
    
    <?php include 'templates/admin/layouts/sub-navbar.php'; ?>

     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-semibold leading-none text-gray-900">
         User Listing
        </h1>
        <div class="flex items-center flex-wrap gap-1.5 font-medium">
         <span class="text-md text-gray-600">
          Total Users:
         </span>
         <span class="text-md text-gray-800 font-semibold me-2">
         <?= count($users); ?>
         </span>
         <span class="text-md text-gray-600">
          Active Users
         </span>
         <span class="text-md text-gray-800 font-semibold">
          <?= count($activeUsers); ?>
         </span>
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="#">
            Import CSV
        </a>
        <a class="btn btn-sm btn-primary" href="/admin/users/add">
            Add
        </a>
       </div>
      </div>
     </div>
     <!-- end: container -->
     <!-- begin: container -->
     <div class="container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <div class="card card-grid min-w-full">
        <div class="card-header flex-wrap gap-2">
         <h3 class="card-title font-medium text-sm">
          Showing 20 of <?= count($users); ?> users
         </h3>
         <div class="flex flex-wrap gap-2 lg:gap-5">
          <div class="flex">
           <label class="input input-sm">
            <i class="ki-filled ki-magnifier">
            </i>
            <input placeholder="Search users" type="text" value="">
            </input>
           </label>
          </div>
          <div class="flex flex-wrap gap-2.5">
           <select class="select select-sm w-28">
            <option value="1">
             Active
            </option>
            <option value="2">
             Disabled
            </option>
            <option value="2">
             Pending
            </option>
           </select>
           <select class="select select-sm w-28">
            <option value="1">
             Latest
            </option>
            <option value="2">
             Older
            </option>
            <option value="3">
             Oldest
            </option>
           </select>
           <button class="btn btn-sm btn-outline btn-primary">
            <i class="ki-filled ki-setting-4">
            </i>
            Filters
           </button>
          </div>
         </div>
        </div>
        <div class="card-body">
         <div data-datatable="true" data-datatable-page-size="20">
          <div class="scrollable-x-auto">
           <table class="table table-auto table-border" data-datatable-table="true">
            <thead>
             <tr>
              <th class="w-[60px] text-center">
               <input class="checkbox checkbox-sm" data-datatable-check="true" type="checkbox"/>
              </th>
              <th class="min-w-[300px]">
               <span class="sort asc">
                <span class="sort-label">
                 User
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label">
                 Role
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label">
                 Status
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label">
                 Location
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              <!-- <th class="min-w-[180px]">
               <span class="sort">
                <span class="sort-label">
                 Activity
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th> -->
              <th class="w-[60px]">
              </th>
             </tr>
            </thead>
            <tbody>

            <?php
                foreach($users as $eachUser){
            ?>

            <tr>
              <td class="text-center">
               <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="1"/>
              </td>
              <td>
               <div class="flex items-center gap-2.5">
                <img src="<?php if(isset($eachUser['profile']['photo'])){ if(!empty($eachUser['profile']['photo'])){ echo '/'.$eachUser['profile']['photo']; }else{ echo '/resources/media/avatars/blank.png'; } }else{ echo '/resources/media/avatars/blank.png'; }?>" alt="/resources/media/avatars/blank.png" class="rounded-full size-9 shrink-0"/>
                <div class="flex flex-col">
                 <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
                    <?= $eachUser['name'];?>
                 </a>
                 <a class="text-2sm font-medium text-gray-600 hover:text-primary-active" href="#">
                    <?= $eachUser['email'];?>
                 </a>
                </div>
               </div>
              </td>
              <td>
              <?= $eachUser['role']; ?>
              </td>
              <td>

                <?php 
                    if($eachUser['status'] == 'INACTIVE'){
                ?>
                    <span class="badge badge-warning badge-outline rounded-[30px]">
                        <span class="size-1.5 rounded-full bg-warning me-1.5">
                        </span>
                        In Active
                    </span>
                <?php
                    }
                    else if($eachUser['status'] == 'ACTIVE'){
                ?>
                    <span class="badge badge-success badge-outline rounded-[30px]">
                        <span class="size-1.5 rounded-full bg-success me-1.5">
                        </span>
                        Active
                    </span>
                <?php
                    }  
                    else if($eachUser['status'] == 'DELETED'){
                ?>
                    <span class="badge badge-danger badge-outline rounded-[30px]">
                        <span class="size-1.5 rounded-full bg-danger me-1.5">
                        </span>
                        Deleted
                    </span>
                <?php
                    }
                ?>

              </td>

              <td>
               <div class="flex items-center gap-1.5">
                <?php 
                    if(isset($eachUser['profile']['country'])){
                ?>
                    <img alt="" class="rounded-full size-4 shrink-0" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/flags/malaysia.svg"/>
                <?php
                        echo $eachUser['profile']['country'];
                    }
                ?>
               </div>
              </td>

              <!-- <td>
               Week ago
              </td> -->

              <td class="text-center">
               <div class="menu flex-inline" data-menu="true">
                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                 <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                  <i class="ki-filled ki-dots-vertical">
                  </i>
                 </button>
                 <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                  <div class="menu-item">
                   <a class="menu-link" href="#">
                    <span class="menu-icon">
                     <i class="ki-filled ki-search-list">
                     </i>
                    </span>
                    <span class="menu-title">
                     View
                    </span>
                   </a>
                  </div>
                  <div class="menu-item">
                   <a class="menu-link" href="#">
                    <span class="menu-icon">
                     <i class="ki-filled ki-file-up">
                     </i>
                    </span>
                    <span class="menu-title">
                     Export
                    </span>
                   </a>
                  </div>
                  <div class="menu-separator">
                  </div>
                  <div class="menu-item">
                   <a class="menu-link" href="/admin/users/edit?id=<?php echo $eachUser['id'];?>">
                    <span class="menu-icon">
                     <i class="ki-filled ki-pencil">
                     </i>
                    </span>
                    <span class="menu-title">
                     Edit
                    </span>
                   </a>
                  </div>
                  <div class="menu-item">
                   <a class="menu-link" href="#">
                    <span class="menu-icon">
                     <i class="ki-filled ki-copy">
                     </i>
                    </span>
                    <span class="menu-title">
                     Make a copy
                    </span>
                   </a>
                  </div>
                  <div class="menu-separator">
                  </div>
                  <div class="menu-item">
                   <button class="btn menu-link admin-user-remove-btn" data-modal-toggle="#admin-user-delete-modal" data-user-id="<?=$eachUser['id'];?>">
                        <span class="menu-icon">
                            <i class="ki-filled ki-trash">
                            </i>
                        </span>
                        <span class="menu-title">
                            Remove
                        </span>
                    </button>
                  </div>
                 </div>
                </div>
               </div>
              </td>
            </tr>

            <?php
                }
            ?>
            </tbody>
           </table>
          </div>
          <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
           <div class="flex items-center gap-2 order-2 md:order-1">
            Show
            <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
            </select>
            per page
           </div>
           <div class="flex items-center gap-4 order-1 md:order-2">
            <span data-datatable-info="true">
            </span>
            <div class="pagination" data-datatable-pagination="true">
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      
      </div>
     </div>
     <!-- end: container -->

    <div class="modal" data-modal="true" id="admin-user-delete-modal">
        <div class="modal-content modal-center max-w-[600px] top-[10%]">
            <div class="modal-header">
                <h1 class="text-xl font-semibold leading-none text-gray-900">
                    Remove User
                </h1>
                <a class="btn btn-sm btn-light" data-modal-dismiss="true" href="#">
                    Close
                </a>
            </div>
            <div class="modal-body flex items-center gap-2 text-sm font-medium text-gray-600">
            
            <input type="hidden" value="" name="user_id" id="admin-user-delete-modal-user-id">
              Are you sure you want to remove this user?
            </div>
            <hr>
            <div class="modal-footer justify-end p-2">
                <div class="flex justify-end gap-2.5">
                    <button class="btn btn-light" data-modal-dismiss="true">
                        Cancel
                    </button>
                    <button class="btn btn-danger" id="admin-user-delete-btn">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
  include 'templates/admin/layouts/footer.php';
?>
