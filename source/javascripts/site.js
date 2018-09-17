// This is where it all goes :)
anchors.add();
(function() {
var burger = document.querySelector('.burger');
var menu = document.querySelector('#'+burger.dataset.target);
burger.addEventListener('click', function() {
    burger.classList.toggle('is-active');
    menu.classList.toggle('is-active');
});
})();

