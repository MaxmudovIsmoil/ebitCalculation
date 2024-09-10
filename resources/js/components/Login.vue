<template>

<div class="container d-flex justify-content-center align-items-center vh-100">
       <div class="shadow rounded center-block">
           <div class="card border-0 p-5" style="width: 55rem">
               <div class="row g-0">
                   <div class="col-6">
                       <div class="card-body">
                           <form action="https://weekly-test.etc-network.uz/login" class="mx-auto" method="POST">
                               <div class="text-start">
                                   <h2>Sign in</h2>
                                   <p class="fs-15">Weekly | For directors</p>
                               </div>
                               <input type="hidden" name="_token" value="4elnDAAmu978S5LJ0bPt3aqc07mJbC4NbWm0QHQR" autocomplete="off">                               <div class="row mt-4">
                                                                      <div class="col-10">
                                       <div class="form-group mb-3">
                                           <label class="form-label">Username</label>
                                           <input type="text" name="login" class="form-control">
                                       </div>
                                       <div class="form-group mb-3">
                                           <label class="form-label">Password</label>
                                           <input type="password" class="form-control" name="password">
                                       </div>
                                   </div>
                               </div>
                               <button class="btn btn-danger w-8 btn-lg font-500 mt-3" type="submit">Sign in</button>
                           </form>
                       </div>
                   </div>
                   <div class="col-6">
                       <img class="img-fluid ms-5 mt-4" style="width: 85%" src="https://weekly-test.etc-network.uz/assets/img/login-image.png" alt="Logo">
                   </div>
               </div>
           </div>
       </div>
   </div>
     
</template>
