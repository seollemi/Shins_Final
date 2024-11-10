document.querySelectorAll('#dp1 #dp1').forEach(function (item) {
     item.addEventListener('click', function (e) {
         e.preventDefault();
         var button = this.closest('.dropdown').querySelector('.dropdown-toggle');
         button.textContent = this.getAttribute('data-size');
     });
 });

 function showSidebar() {
     const sidebar = document.querySelector(".sidebar");
     sidebar.style.display = "flex";
 }
 function closeSB() {
     const sidebar = document.querySelector(".sidebar");
     sidebar.style.display = "none";
 }
 // JavaScript to keep the dropdown open on click
 document.querySelectorAll('#dp1 #dp1').forEach(item => {
     item.addEventListener('click', event => {
         event.preventDefault();
         var target = item.getAttribute('href');
         document.querySelector(target).scrollIntoView({
             behavior: 'smooth'
         });
     });
 });


        