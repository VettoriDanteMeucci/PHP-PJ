const t = document.getElementById("sub");
const cont = document.getElementById("images")
const ins = document.querySelectorAll("#images input[type='file']")
const addText = document.querySelector("#new_text")
const text_container = document.querySelector("#text_container");
let counter = 0;

const handleChange = (item) => {
    if(item.value != "" && counter < 2){
        let tmp = document.createElement("input");
        tmp.type = "file";
        tmp.accept = "image/*";
        tmp.classList.add("form-control");
        counter++;
        tmp.name = "image"+counter;
        tmp.addEventListener("change", handleChange)
        cont.append(tmp)
    }
}

document.addEventListener("DOMContentLoaded", () => {
    ins.forEach(item =>
        item.addEventListener("change", handleChange)
    )
})

addText.addEventListener("click", () => {
    let text = document.createElement("textarea");
    text.setAttribute("name" , "text[]");
})