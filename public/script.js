// -----------------   for home page and header page -----------------------

// When the user scrolls the page, execute myFunction
window.onscroll = function() {
    myFunction();
    stateTempProCard();
};

// Get the header
var header = document.getElementById("myHeader");
var aboutContent = document.getElementById("about-info");
var friendLD = document.getElementById("friend-l-d");
var tempProCard = document.getElementById("temp-p-d");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.remove("mx-3");
        header.classList.add("nav-head");
        aboutContent.classList.add('about-side');
        friendLD.classList.add('temp-f-c')
    } else {
        header.classList.add("mx-3");
        header.classList.remove("nav-head");
        aboutContent.classList.remove('about-side');
        friendLD.classList.remove('temp-f-c')
    }
}


function stateTempProCard() {
    if (window.pageXOffset > sticky) {
        tempProCard.classList.add("temp-p-c");
    } else {
        tempProCard.classList.remove("temp-p-c");
    }
}


// from friend list

function showTempProfile(id, name, image, mobile, gender, birthDay, email) {

    document.getElementById("temp-p-d").style = 'block';

    $("#img-t").attr("src", image); // set image ser 
    $("#surName").text(name); // set user name
    $("#mobile").text(mobile); // set user mobile number
    $("#dateOfBirth").text(birthDay); // set user birth day
    $("#gender").text(gender); // set user gender
    $("#email").text(email); // set email
    $("#pro-link").attr("href", 'profile?id=' + id); // set user profile link
    $("#add-link").attr("href", 'addFriend?loc=pubFriends&friendId=' + id); // set user profile link
}














// // -------------------------- For image gallery ------------------------------

// // Get the modal
// var modal = document.getElementById('myModal');

// // Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById('myImg');
// img.onclick = function() {
//     var getImageId = document.querySelector('.modal-content').id;
//     console.log(getImageId);
//     var modalImg = document.getElementById(getImageId);

//     modal.style.display = "block";
//     modalImg.src = this.src;

//     console.log('hello...')
// }

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//     modal.style.display = "none";
// }