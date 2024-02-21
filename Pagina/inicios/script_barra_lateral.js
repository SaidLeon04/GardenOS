    const body = document.querySelector('body'), //obtiene el elemento body 
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click" , () =>{  
      sidebar.classList.toggle("close");
    })


    modeSwitch.addEventListener("click" , () =>{
      body.classList.toggle("dark");

    if(body.classList.contains("dark")){
      modeText.innerText = "Modo Claro";
    }else{
      modeText.innerText = "Modo Oscuro";
    }
    });