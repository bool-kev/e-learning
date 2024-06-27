window.addEventListener('resize',(e)=>{
    if (window.innerWidth<="768"){
        document.getElementById('accordionSidebar').style.width="14rem";
        document.querySelector('#niveau-md').parentElement.classList.add('d-none');
        document.querySelector('#niveau').parentElement.classList.remove('d-none');
        console.log('okay');
    }else {
        document.getElementById('accordionSidebar').style.width="22rem";
        document.querySelector('#niveau').parentElement.classList.add('d-none');
        document.querySelector('#niveau-md').parentElement.classList.remove('d-none');    }
    console.log(document.getElementById('accordionSidebar').style.width);
});
dispatchEvent(new Event('resize'));

document.querySelector('#searchDropdown .bi-search').addEventListener('click',(e)=>{
    document.getElementById('bi-search').classList.toggle('show');
})