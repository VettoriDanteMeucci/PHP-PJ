import MDreader from "./md-reader.js";
const root = document.getElementById("root");
let isLogged = -1
let id = -1;

function errorFound(){
    let error = document.createElement("h1")
    error.textContent = "No data available for this page"
    error.className = "fs-1 text-danger text-center my-5"
    root.append(error)
}

function render (data) {
    console.log(data)
    if(data == null || (data.images == false && data.texts.length == 0)){
        errorFound();
        return;
    }
    console.log(data, "d")
    let title = createHeader(data.page.name, data.page.id);
    title.classList.add("display-4");
    root.append(title)
    let ids = renderMenu(data)
    imgsRender(data)
    renderTexts(data,ids)
    showComments(data.comments, isLogged)
}

/**
 * 
 * @param data obtained by the fetch 
 * @returns the list of all indexes
 */
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
    let texts = data.texts;
    texts.forEach((item, index)=> {
            let div = document.createElement("div");
            div.append(createHeader(item.title, ids[index]))
            let p = document.createElement("p");
            let mod = document.createElement("button")
            mod.className = "btn btn-warning"
            mod.textContent = "Modifica"
            const prova = () => {
                modify(div, p, item)
            }
            mod.addEventListener("click", prova)
            div.append(mod)
            p.innerHTML = new MDreader(item.body).init();
            div.appendChild(p);
            root.append(div)
        }
    )
}

function modify(div, p, item){
    let form = document.createElement("form");
    let tearea = document.createElement("textarea");
    let title = document.createElement("input");
    let submit = document.createElement("button");
    let hidden = document.createElement("input");
    let hidden2 = document.createElement("input");
    title.type = "text"
    title.value = item.title
    title.name = "title"
    title.className = "form-control mb-2"
    hidden.type = "hidden";
    hidden2.type = "hidden";
    hidden.name = "textID"
    hidden2.name = "pageID"
    hidden2.value = id;
    hidden.value = item.id;
    submit.className = "btn btn-primary mt-2"
    submit.textContent = "Salva"
    tearea.value = item.body;
    tearea.name = "body"
    tearea.className = "form-control w-100"
    form.append(title);
    form.appendChild(tearea);
    form.appendChild(submit);
    form.append(hidden, hidden2);
    form.method = "POST"
    form.action = "http://localhost/PHP-PJ/actions/updateText.php"
    root.replaceChild(form, div)
}

function createHeader(title, id){
    let header = document.createElement("h1");
    header.textContent = title;
    header.className = "font-minecraft-ten"
    header.id = id;
    return header
}

function imgsRender(data) {
    if(data.images == false) return false;
    let img_cont = document.createElement("div");
    let img_n = data.images.length
    img_cont.className = "row col-9 text-center row-cols-" + img_n;
    data.images.forEach(src => {
        let img = document.createElement("img");
        img.style.maxHeight = "40vh";
        img.style.maxWidth = "100%"
        img.src = src;
        let di = document.createElement("div")
        di.className = "p-2"
        di.appendChild(img)
        img_cont.append(di);
    });
    root.append(img_cont)
}

function showComments(comments ,isLogged){
    console.log(comments)
    let section = document.createElement("div")
    section.className = "bg-bricks row rounded section-comm mb-3"
    comments.forEach(comment => {
        let elem = document.createElement("div");
        elem.className = "rounded"
        let tit = document.createElement("a");
        let body = document.createElement("p");
        tit.innerHTML = comment.creator || "deleted user"
        tit.href = comment.creator_id != null ?
        "http://localhost/PHP-PJ/pages/viewCreator.php?id=" + comment.creator_id
        :
        "http://localhost/PHP-PJ"
        body.innerHTML = new MDreader(comment.body).init()
        elem.append(tit)
        elem.append(body)
        section.append(elem)
    })
    isLogged && createCommentForm(section) 
    root.append(section)
}

function createCommentForm(section){
    let form = document.createElement("form");
    let lab = document.createElement("label");
    let comm = document.createElement("textarea");
    let submit = document.createElement("button");
    let hidden = document.createElement("input");
    hidden.type = "hidden"
    hidden.name = "pageID";
    hidden.value = id;
    lab.innerText = "Il tuo commento";
    comm.name = "body"
    comm.placeholder = "Mi piace molto questa pagina"
    comm.className = "form-control"
    submit.innerText = "Invia"
    submit.className = "btn btn-primary mt-3"
    form.appendChild(lab)
    form.appendChild(comm)
    form.appendChild(hidden)
    form.appendChild(submit)
    form.className = "col-11 mb-3 bg-stone form-stone col-lg-8 mx-auto mt-5 px-3 py-4 rounded"
    form.method="POST"
    form.action="../actions/addComment.php"
    section.append(form)
}


document.addEventListener("DOMContentLoaded", () => {
    id = root.getAttribute("data-id")
    isLogged = root.getAttribute("data-logged") == 1;
    console.log(isLogged)
    console.log(id);
    if(id == -1) return;
    fetch("http://localhost/PHP-PJ/api/getPage.php?id=" + id)
    .then(res => {
        if(!res.ok){
            return null
        }else{
            return res.json()
        }
    }
    ).then(data => render(data));
})