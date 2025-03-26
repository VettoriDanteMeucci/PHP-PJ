const t = document.getElementById("sub");
const cont = document.getElementById("images")
const ins = document.querySelectorAll("#images input") 
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