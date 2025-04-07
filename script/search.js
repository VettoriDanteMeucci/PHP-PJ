const search = document.querySelector("#search input");
const show = document.querySelector("#search #show")


function isPage (name){
    return name.charAt(0) != "@"
}

function addVoice(name ,id){
    let a = document.createElement("a")
    a.innerHTML = name
    if(isPage(search.value)){
        a.href = "http://localhost/PHP-PJ/pages/viewTutorial.php?id="+ id
    }else{
        a.href = "http://localhost/PHP-PJ/pages/viewCreator.php?id=" + id
    }
    a.className = "dropdown-item"
    let li = document.createElement("li");
    li.append(a)
    show.append(li)
}

function showIn(info){
    console.log(info)
    show.innerHTML = ""
    if(info.length == 0){
        show.classList.remove("show")
    }else{
        info.forEach(item => {
            if(isPage(search.value)){
                addVoice(item.name, item.id)
            }else{
                addVoice(item.username,item.id)
            }
        });
        show.classList.add("show")
    }
}

document.addEventListener("DOMContentLoaded", () => {
    console.log(search)
})

search.addEventListener("input", () => {
    input = search.value
    let typePage = isPage(input);
    const fetchTo = typePage ? 
        "http://localhost/PHP-PJ/api/searchPage.php?name="
    :
        "http://localhost/PHP-PJ/api/searchUser.php?name=";
    
    if(!typePage){input = input.replace("@", "")}
    if(input !== ""){
        fetch(fetchTo + input)
        .then(res =>
            {
            if(!res.ok){
                return null
            }else{
                return res.json()
            }
        }
        ).then(data => showIn(data))
    }else{
        show.innerHTML = ""
        show.classList.remove("show")
        console.log("empty input")
    }
})