/*----------drop-down-menu (sign in)----------
const signInBtn = document.querySelector('.sign-in-btn');
const dropSignIn = document.querySelector('.drop-sign-in');
function toggleDropSignIn() {
    signInBtn.classList.toggle('on-click');
    dropSignIn.classList.toggle('show');
}
signInBtn.addEventListener('click', toggleDropSignIn);

*/

/*----------add font----------*/
window.WebFontConfig = {
    google: {
        families: ['Zen+Kaku+Gothic+New: 400, 700, 900']
    },
    active: function () {
        sessionStorage.fonts = true;
    }
};

(function () {
    var wf = document.createElement('script');
    wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();

/*----------drop-down-menu (sign in)----------*/
const signInBtn = document.querySelector('.sign-in-btn');
const dropSignIn = document.querySelector('.drop-sign-in');

function showDropSignIn() {
    dropSignIn.classList.add('show');
}

function hideDropSignIn() {
    dropSignIn.classList.remove('show');
}

signInBtn.addEventListener('mouseover', showDropSignIn);
signInBtn.addEventListener('mouseout', hideDropSignIn);
dropSignIn.addEventListener('mouseover', showDropSignIn);
dropSignIn.addEventListener('mouseout', hideDropSignIn);