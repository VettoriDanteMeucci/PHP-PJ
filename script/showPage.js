const root = document.getElementById("root");
let id = -1;

function render (data) {
    if(data.images == false && data.texts.length == 0){
        let error = document.createElement("h1")
        error.textContent = "No data available for this page"
        error.className = "fs-1 text-danger text-center my-5"
        root.append(error)
        return;
    }
    console.log(data)
    let ids = renderMenu(data)
    imgsRender(data)
    renderTexts(data,ids)
}

function renderMenu(data){
    let pos = data.texts.map(text =>
        text.title
    )
    let list = document.createElement("ol")
    let ans = [];
    pos.forEach((item, index) => {
        let li = document.createElement("li")
        let link = document.createElement("a");
        let id = "pos"+index;
        ans.push(id)
        link.href = "#" + id
        link.textContent = item;
        li.appendChild(link)
        list.appendChild(li);
    })
    list.className = "col-3"
    root.appendChild(list)
    console.log(pos)
    return ans;
}

function renderTexts(data, ids){
    texts = data.texts;
    texts.forEach((item, index)=> {
            let div = document.createElement("div");
            div.append(createHeader(item.title, ids[index]))
            let p = document.createElement("p");
            p.textContent = item.body;
            div.appendChild(p);
            root.append(div)
        }
    )
}

function createHeader(title, id){
    let header = document.createElement("h1");
    header.textContent = title;
    header.id = id;
    return header;
}

function imgsRender(data) {
    if(data.images == false) return false;
    let img_cont = document.createElement("div");
    let img_n = data.images.length
    img_cont.className = "row col-9 text-center row-cols-" + img_n;
    data.images.forEach(src => {
        let img = document.createElement("img");
        img.style = "max-height: 40vh, max-width: 100%";
        img.src = src;
        let di = document.createElement("div")
        di.className = "p-2"
        di.appendChild(img)
        img_cont.append(di);
    });
    root.append(img_cont)
}

document.addEventListener("DOMContentLoaded", () => {
    id = root.getAttribute("data-id")
    console.log(id);
    if(id == -1) return;
    datas = fetch("http://localhost/PHP-PJ/api/getPage.php?id=" + id)
    .then(res => {
        if(!res.ok){
            return null
        }else{
            return res.json()
        }
    }
    ).then(data => render(data));
})