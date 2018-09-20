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
    // when scroll down then remove and add some class
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


// ------------------- from friend list

// set profile information from databse using jquery.
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
    $("#delete-link").attr("href", 'unFriend?loc=friends&friendId=' + id); // set user profile link
}




// ------------------------ from profile page -----------------------

// get comment button,  when comment button click then 
// comment show, next click comment hide.
$('button.comment-button').on('click', function() {
    $('div.comment-box').fadeToggle(900);
});








// // -------------------------- For image gallery ------------------------------

// // Get the modal
var modal = document.getElementById('myModal');

// if click img then show image in popup
function showImg(pSrc) {
    var modalImg = document.getElementById('img');
    modal.style.display = "block";
    modalImg.src = pSrc;
}

// // Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// // When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}



// ---------------------------- from deshbord page ------------------

// function for show like in page
function showLikes(idName) {
    document.getElementById(idName).style.display = "block";
}

// function for hide like in page
function closeLike(idName) {
    document.getElementById(idName).style.display = "none";
}


// ---------------------------- from header page ------------------

// function for show like in page
function showNotifi(idName) {
    document.getElementById(idName).style.display = "block";
}

// function for hide like in page
function closeNotifi(idName) {
    document.getElementById(idName).style.display = "none";
}