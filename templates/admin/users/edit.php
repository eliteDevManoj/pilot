<?php 
  include 'templates/admin/layouts/header.php';
?>

<div class="flex grow">
  
  <?php include 'templates/admin/layouts/sidebar.php'; ?>

   <div class="wrapper flex grow flex-col">

    <?php include 'templates/admin/layouts/navbar.php'; ?>

    <main class="grow content pt-5" id="content" role="content">
    
    <?php include 'templates/admin/layouts/sub-navbar.php'; ?>

     <!-- begin: container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-semibold leading-none text-gray-900">
         User - Edit
        </h1>
        <div class="flex items-center gap-2 text-sm font-medium text-gray-600">
         Edit form below to update this user.
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        <!-- <a class="btn btn-sm btn-light" href="#">
         Public Profile
        </a>
        <a class="btn btn-sm btn-primary" href="#">
         Get Started
        </a> -->
       </div>
      </div>
     </div>
     <!-- end: container -->
     <!-- begin: container -->

     <div class="container-fixed">
      
     <form method="post" action="/admin/users/update" enctype="multipart/form-data" id="user-edit-form">
      
      <input type="hidden" name="id" value="<?= $getUser['id'];?>">
      <!-- <input type="hidden" name="_method" value="PUT"> -->

      <div class="grid gap-5 lg:gap-7.5 xl:w-[38.75rem] mx-auto">
       <div class="card pb-2.5">
        <div class="card-header" id="basic_settings">
         <h3 class="card-title">
          General Settings
         </h3>
         <div class="flex items-center gap-2">
          <label class="switch switch-sm">
           <span class="switch-label">
            Public Profile
           </span>
           <input <?php if(isset($getUser['profile']['is_public'])){ if($getUser['profile']['is_public'] == 'ACTIVE'){ ?> checked <?php } } ?> name="is_profile_public[]" type="checkbox" value="1"/>
          </label>
         </div>
        </div>
        <div class="card-body grid gap-5">
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Photo
          </label>
           <div class="flex items-center text-2sm font-medium text-gray-600">
            <input accept="*" name="fileToUpload" type="file" id="profile-avatar">
              <div class="image-input size-16">
                <div class="image-input-placeholder rounded-full border-2 border-success image-input-empty:border-gray-300" style="background-image:url(../../../../../static/metronic/tailwind/dist/assets/media/avatars/blank.png)">
                  <img id="userProfileAvatar" src="<?php if(isset($getUser['profile']['photo'])){ echo '/'.$getUser['profile']['photo']; }else{ echo '/resources/media/avatars/blank.png'; }?>" alt="/resources/media/avatars/300-2.png" class="image-input-preview rounded-full">
                  </div>
                </div>
            </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Name
          </label>
          <input class="input" type="text" name="user_name" placeholder="name" value="<?php if(isset($getUser['name'])){ echo $getUser['name']; } ?>"/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Phone number
          </label>
          <input class="input" placeholder="phone number" name="user_phone" type="text" value="<?php if(isset($getUser['phone'])){ echo $getUser['phone']; } ?>"/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Email
          </label>
          <input disabled class="input" placeholder="example@gmail.com" name="user_email" type="text" value="<?php if(isset($getUser['email'])){ echo $getUser['email']; } ?>"/>
         </div>

         <!-- <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Password
          </label>
          <input class="input" placeholder="password" name="user_password" type="password" value=""/>
         </div> -->

         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Address
          </label>
          <input class="input" placeholder="address" name="user_address" type="text" value="<?php if(isset($getUser['profile']['address'])){ echo $getUser['profile']['address']; } ?>"/>
         </div>
         
         <!-- <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Country
          </label>
          <select class="select">
           <option>
            Spain
           </option>
           <option>
            Option 2
           </option>
           <option>
            Option 3
           </option>
          </select>
         </div> -->
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           Country
          </label>
          <input class="input" placeholder="country" name="user_country" type="text" value="<?php if(isset($getUser['profile']['country'])){ echo $getUser['profile']['country']; } ?>"/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           State
          </label>
          <input class="input" placeholder="state" name="user_state" type="text" value="<?php if(isset($getUser['profile']['state'])){ echo $getUser['profile']['state']; } ?>"/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56">
           City
          </label>
          <input class="input" placeholder="city" name="user_city" type="text" value="<?php if(isset($getUser['profile']['city'])){ echo $getUser['profile']['city']; } ?>"/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          <label class="form-label max-w-56">
           Postcode
          </label>
          <input class="input" placeholder="postal code" name = "user_postal_code" type="text" value="<?php if(isset($getUser['profile']['postal_code'])){ echo $getUser['profile']['postal_code']; } ?>"/>
         </div>
         <div class="flex justify-end">
          <button class="btn btn-primary" type="submit">
           Update
          </button>
         </div>
        </div>
       </div>

     </form>
     
      
      </div>
     </div>
     <!-- end: container -->

<?php
  include 'templates/admin/layouts/footer.php';
?>
