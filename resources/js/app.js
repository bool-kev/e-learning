import './bootstrap';
// import 'bootstrap'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

window.addEventListener('resize',(e)=>{
    if (window.innerWidth<="768"){
        document.getElementById('accordionSidebar').style.width="14rem";
        console.log('okay');
    }else {
        document.getElementById('accordionSidebar').style.width="22rem";
    }
    console.log(document.getElementById('accordionSidebar').style.width);
});
if (window.innerWidth<="768"){
    document.getElementById('accordionSidebar').style.width="14rem";
    console.log('okay');
}else {
    document.getElementById('accordionSidebar').style.width="22rem";
}
console.log(document.getElementById('accordionSidebar').style.width);