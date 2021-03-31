const network = new brain.NeuralNetwork();

network.train([
    //{ input: {sot:0,ho:0,chayncmui:0,tacmui:0,hathoi:0,dauhong:0,rathong:0,khotho:0,codommu:0,nonmua:0,tieuchay:0,kocosuc:0,dauco:0,xquangphoimo:0}, output: {No:1} },
    { input: 
        {
            sot:1,
            ho:1,
            chayncmui:0,
            tacmui:0,
            hathoi:0,
            dauhong:0,
            rathong:1,
            khotho:1,
            codommu:1,
            nonmua:0,
            tieuchay:0,
            kocosuc:1,
            dauco:1,
            xquangphoimo:1
        }, 
        output: {CoV:1} 
    },
    { input: {sot:1,ho:1,chayncmui:1,tacmui:0,hathoi:1,dauhong:0,rathong:0,khotho:0,codommu:0,nonmua:1,tieuchay:1,kocosuc:0,dauco:1,xquangphoimo:0}, output: {Cum:1} },
    { input: {sot:0,ho:1,chayncmui:0,tacmui:1,hathoi:1,dauhong:1,rathong:1,khotho:0,codommu:0,nonmua:0,tieuchay:0,kocosuc:0,dauco:0,xquangphoimo:0}, output: {Camlanh:1} },
    { input: {sot:1,ho:0,chayncmui:0,tacmui:0,hathoi:0,dauhong:0,rathong:0,khotho:0,codommu:0,nonmua:0,tieuchay:0,kocosuc:0,dauco:0,xquangphoimo:0}, output: {CoV:1,Cum:1}}
]);
function start()
{
d=0;
var arr = [];
n=15;
for(i = 1;i<n;i++)
{if(document.getElementById(i).checked == true)
    { arr[d]=1;}
    else {arr[d]=0;}
    d++;
}
console.log({sot:arr[0],ho:arr[1],chayncmui:arr[2],tacmui:arr[3],hathoi:arr[4],dauhong:arr[5],rathong:arr[6],khotho:arr[7],codommu:arr[8],nonmua:arr[9],tieuchay:arr[10],kocosuc:arr[11],dauco:arr[12],xquangphoimo:arr[13]});
const result = brain.likely({sot:arr[0],ho:arr[1],chayncmui:arr[2],tacmui:arr[3],hathoi:arr[4],dauhong:arr[5],rathong:arr[6],khotho:arr[7],codommu:arr[8],nonmua:arr[9],tieuchay:arr[10],kocosuc:arr[11],dauco:arr[12],xquangphoimo:arr[13]}, network);
const result2 = network.run({sot:arr[0],ho:arr[1],chayncmui:arr[2],tacmui:arr[3],hathoi:arr[4],dauhong:arr[5],rathong:arr[6],khotho:arr[7],codommu:arr[8],nonmua:arr[9],tieuchay:arr[10],kocosuc:arr[11],dauco:arr[12],xquangphoimo:arr[13]}, network);
console.log(result);
console.log(result2);
dd=0;
a = 0;
for(i=1 ; i<n ;i++){
    if(arr[dd]==1)
        a = 1;
    dd++;
}
if(a == 1){
document.getElementById("error-answers").style.display = "none";
document.getElementById("info-lich").style.display = "inherit";
document.querySelector(".per-bars").style.display = "flex";
document.getElementById("traloi").style.width =  Math.round(result2.CoV * 100)+"%" ;
document.getElementById("phantram").innerHTML =  Math.round(result2.CoV * 100)+"%" ;
document.getElementById("traloi2").style.width =  Math.round(result2.Cum * 100)+"%" ;
document.getElementById("phantram2").innerHTML =  Math.round(result2.Cum * 100)+"%" ;
document.getElementById("traloi3").style.width =  Math.round(result2.Camlanh * 100)+"%" ;
document.getElementById("phantram3").innerHTML =  Math.round(result2.Camlanh * 100)+"%" ;
    if(result === "CoV"){
        document.getElementById("warning-lich").innerHTML = "Bạn đang gặp phải những triệu chứng người nhiễm Covid thường gặp, hãy : ";
        document.getElementById("info-lich").href = "?cn=Bệnh viện Đa khoa Quốc tế Vinmec Times City&k=Khoa Khám bệnh va Nội khoa#s3";
        document.getElementById("info-lich").innerHTML = "Đặt lịch ở Khoa Khám bệnh và Nội khoa";
    }
    else{
        if(result === "Cum") {
            document.getElementById("warning-lich").innerHTML = "Theo như số liệu thì bạn đang bị cảm cúm, hãy :";
            document.getElementById("info-lich").href = "?cn=Bệnh viện Đa khoa Quốc tế Vinmec Times City&k=Khoa Xét nghiệm#s3";
            document.getElementById("info-lich").innerHTML = "Đặt lịch ở Khoa Khám bệnh và Nội khoa";
        }
        else {
            document.getElementById("warning-lich").innerHTML = "Theo như số liệu thì bạn đang bị cảm lạnh" ; 
            document.getElementById("info-lich").innerHTML = "";
            }
    }
}
else{
    document.getElementById("error-answers").style.display = "inherit";
    document.getElementById("error-answers").innerHTML = "Hãy chọn 1 trong những triệu chứng trên...";
    document.querySelector(".per-bars").style.display = "none";
    document.getElementById("info-lich").style.display = "none";
}
}
////////////////////////////////////////////
function decision(arr){
    cov = 0;
    c = 0;
    cl = 0;
    if(arr[0] == 1){
        cov = cov + 3;
        c = c + 3 ;
    }
    if(arr[1] == 1){
        cov = cov + 3;
        c = c + 3;
        cl = cl + 2;
    }
    if(arr[2] == 1){
        c = c + 2;
        cl = cl + 3;
    }
    if(arr[3] == 1){
        cl = cl + 3;
    }
    if(arr[4] == 1){
        c = c + 2;
        cl = cl + 3;
    }
    if(arr[5] == 1){
        cl = cl + 3;
    }
    if(arr[6] == 1){
        cov = cov + 2;
        cl = cl + 3
    }
    if(arr[7] == 1){
        cov = cov + 3;
    }
    if(arr[8] == 1){
        cov = cov + 3;
    }
    if(arr[9] == 1){
        c = c + 3;
    }
    if(arr[10] == 1){
        c = c + 3;
    }
    if(arr[11] == 1){
        cov = cov + 3;
    }
    if(arr[12] == 1){
        cov = cov + 2;
        c = c + 3;
    }
    if(arr[13] == 1){
        cov = cov + 3;
    }
    if(arr[0]==0&&arr[1]==0&&arr[2]==0&&arr[3]==0&&arr[4]==0&&arr[5]==0&&arr[6]==0&&arr[7]==0&&arr[8]==0&&arr[9]==0&&arr[10]==0&&arr[11]==0&&arr[12]==0&&arr[13]==0){
        n=15;
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        return 0;
    }
    
    if(cov == c){
        if(cl > cov && cl > c){
            return 'cl';
        }else return 'covc';
    }
    if(cov == cl){
        if(c > cov && c > cl){
            return 'c';
        }else return 'covcl';
    }
    if(c == cl){
        if(cov > c && cov > cl){
            return 'cov';
        }else return 'ccl';
    }
    if(cov > c && cov > cl){
        if(c == cl){
            return 'cov';
        }
        return 'cov';
    }
    if(c > cov && c > cl) {
        if(cov == cl){
            return 'c';
        }
        return 'c';
    }
    if(cl > cov && cl > c ){
        if(cov == c){
            return 'cl';
        }
        return 'cl';
    }
    
}
////////

////////
function survey(){
    d=0;
    var arr = [];
    n=15
    for(i=1;i<n;i++){
        if(document.getElementById(i).checked == true){ //kiểm tra checkbox có được check hay ko (có = 1/ko = 0) và đưa vào mảng arr
            arr[d]=1;
        }else {
            arr[d]=0;
        }
    d++;
    }
    console.log(decision(arr));
    if(decision(arr) === 'covc'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.1;
            x = j + 0.2;
            if(document.getElementById(y).innerHTML == 'PB' || document.getElementById(x).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
                
            }
        }
    }
    if(decision(arr) === 'covcl'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.1;
            x = j + 0.3;
            if(document.getElementById(y).innerHTML == 'PB' || document.getElementById(x).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
            }
        }
    }
    if(decision(arr) === 'ccl'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.2;
            x = j + 0.3;
            if(document.getElementById(y).innerHTML == 'PB' || document.getElementById(x).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
            }
        }
    }
    if(decision(arr) === 'cov'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.1;
            if(document.getElementById(y).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
            }
        }
    }
    if(decision(arr) === 'c'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.2;
            if(document.getElementById(y).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
            }
        }
    }
    if(decision(arr) === 'cl'){
        for(i=1;i<n;i++){
            j = i + 0.5;
            document.getElementById(j).style.color = 'white';
        }
        for(i=1;i<n;i++){
            j = i + 0.5;
            y = j + 0.3;
            if(document.getElementById(y).innerHTML == 'PB'){
                document.getElementById(j).style.color = 'orange';
            }
        }
    }
}
////////////////////////////////////////////ai
//profile image load



window.addEventListener("load", event => {
    var image = document.getElementsByClassName('pro-load');
    for (var i = 0; i < image.length; i++) {
        var isLoaded = image[i].complete && image[i].naturalHeight !== 0;
        if(!isLoaded){
        image[i].src= 'uploads/default-profile-icon-17.jpg';
        }
        setTimeout('', 5000);
    }
    
  });


