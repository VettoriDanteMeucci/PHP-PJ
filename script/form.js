const t = document.getElementById("sub");
const cont = document.getElementById("images")
const ins = document.querySelectorAll("#images input[type='file']")
const addText = document.querySelector("#new_text")
const text_container = document.querySelector("#text_container");
let counter = 0;

const new_img_input = (item) => {
    if(item.value != "" && counter < 2){
        let tmp = document.createElement("input");
        tmp.type = "file";
        tmp.accept = "image/*";
        tmp.classList.add("form-control" , "bg-spruce", "mt-2");
        counter++;
        tmp.name = "image"+counter;
        tmp.addEventListener("change", new_img_input)
        cont.append(tmp)
    }
}

function title_input () {
    let title = document.createElement("input")
    title.classList.add("form-control", "bg-spruce", "fs-3", "w-50")
    title.name = "title[]"
    title.type = "text"
    return title
}

function text_input () {
    let text = document.createElement("textarea");
    text.setAttribute("name" , "text[]");
    text.classList.add("form-control", "bg-spruce");
    return text
}

document.addEventListener("DOMContentLoaded", () => {
    ins.forEach(item =>
        item.addEventListener("change", new_img_input)
    )
})

addText.addEventListener("click", (e) => {
    e.preventDefault()
    console.log("here")
    let title = title_input()
    let text = text_input()
    let div = document.createElement("div")
    div.classList.add("d-flex", "flex-column", "mb-2", "p-2", "gap-2")
    div.append(title, text)
    text_container.append(div);
})