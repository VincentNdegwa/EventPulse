<template>
   <footer class="text-white">
      <div class="container py-5">
         <div class="row">
            <div class="col-md-4">
               <h3 class="text-secondary"> EventPulse</h3>
               <p>Every Detail, Every Event, Every Time</p>
               <p>Join us in making memories that last a lifetime!</p>
            </div>
            <div class="col-md-4">
               <h3 class="text-secondary">Quick Links</h3>
               <ul class="list-unstyled">
                  <li><a href="#" class="text-white">Home</a></li>
                  <li><a href="#" class="text-white">Events</a></li>
                  <li><a href="#" class="text-white">Support</a></li>
                  <li><a href="#" class="text-white">Login/Register</a></li>
               </ul>
            </div>
            <div class="col-md-4">
               <h3 class="text-secondary">Stay Connected</h3>
               <p>Follow us on social media for updates and news!</p>
               <div class="social-icons">
                  <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
               </div>
            </div>
         </div>
         <div class="row mt-5">
            <div class="col-md-6">
               <h3 class="text-secondary">Subscribe to Our Newsletter</h3>
               <form>
                  <div class="input-group mb-3">
                     <input type="email" class="form-control" placeholder="Your Email Address"
                        aria-label="Your Email Address" aria-describedby="button-addon2">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-6">
               <h3 class="text-secondary">About Us</h3>
               <p>We are Joy Bringers, dedicated to crafting extraordinary events that bring
                  communities together.</p>
            </div>
         </div>
      </div>
      <div class="container-fluid text-white py-3">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <p>&copy; 2024 EventPulse. All rights reserved.</p>
               </div>
               <div class="col-md-6 text-right">
                  <p>Designed with <i class="fas fa-heart"></i> by Vincent Ndegwa</p>
               </div>
            </div>
         </div>
      </div>
   </footer>
</template>

<style>
footer {
   width: 100%;
   height: auto;
   background: radial-gradient(circle, var(--main-green) 0%, var(--main-blue) 100%);
   padding: 30px 0;
}

.social-icons a {
   color: white;
   margin-right: 10px;
   text-decoration: none;
   font-size: 1.5rem;
}
</style>
