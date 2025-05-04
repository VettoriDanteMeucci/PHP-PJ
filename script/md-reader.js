const NEWVALUES= {
    bold: "<b>$1</b>",
    italic: "<i>$1</i>",
    underline: "<u>$1</u>",
    mark: "<mark>$1</mark>",
    bold_italic: "<b><i>$1</i></b>",
    h1: "<h1>$1</h1>",
    h2: "<h2>$1</h2>",
    h3: "<h3>$1</h3>",
    li: "<li>$1</li>",
    checkbox: "<input type='checkbox'>",
    link: "<a class='text-primary' href='$2'>$1</a>"
}

export default class MDreader{
    constructor(input){
        this.var = input;
    }

    init(){
        console.log(this.var)
        this.fontStyles();
        this.spacesOrder()
        return this.var
    }

    fontStyles(){
        this.var = this.var.replace(/__(.*)__/g, NEWVALUES.bold);
        this.var = this.var.replace(/_(.*)_/g, NEWVALUES.italic);
        this.var = this.var.replace(/<ins>(.*)<\/ins>/g, NEWVALUES.underline);
        this.var = this.var.replace(/`(.*)`/g, NEWVALUES.mark);
        this.var = this.var.replace(/\*\*\*(.*)\*\*\*/g, NEWVALUES.bold_italic);
        this.var = this.var.replace(/\[\s+\]/g, NEWVALUES.checkbox);
        this.var = this.var.replace(/\[(.*)\]\((.*)\)/g, NEWVALUES.link);
    }

    spacesOrder(){
        let split = this.var.split(/\s\s/g).filter(Boolean)
        let ans = [];
        split.forEach(str => 
            {
                ans.push(this.header(str))
            }
        )
        ans = this.lists(ans);
        let tmp = ""
        ans.forEach(item => {tmp += item})
        this.var = tmp
    }

    lists(splitted){
        let openedList = false
        let checkFor = /(.*)/
        let ans = [];
        splitted.forEach((line, index) => {
            if(/^(\d\.|[\-\*\+])\s/.test(line)){
                if(!openedList){
                    if(/^(\d\.)\s/.test(line)){
                        ans.push("<ol>")
                        checkFor = /^\d\.\s/
                    }else{
                        ans.push("<ul>")
                        checkFor =/[\-\*\+]\s/
                    }
                    openedList = true
                }
                line = line.replace(/^(\d\.|[\-\*\+])\s/, "");
                line = line.replace(/(.*)/, "<li>$1</li>")
                ans.push(line)
                if(!checkFor.test(splitted[index+1])){
                    checkFor.flags == /^\d\.\s/.flags && checkFor.source == /^\d\.\s/.source ?
                    ans.push("</ol>")
                    :
                    ans.push("</ul>")
                    openedList = false;
                }
            }else{
                ans.push(line + "</br>")
            }
        })
        return ans;
    }

    header(val){
        val = val.replace(/^###(.*)/g,NEWVALUES.h3)
        val = val.replace(/^##(.*)/g,NEWVALUES.h2)
        val = val.replace(/^#(.*)/g,NEWVALUES.h1)
        return val;
    }
}
