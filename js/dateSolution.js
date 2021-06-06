convertDate = date => {
    return date.split("-")[2] + "/" + date.split("-")[1] + "/" + date.split("-")[0];
}

compareDate = (d1, d2) => {
    var fd1 = d1.split("-");
    var fd2 = d2.split("-");
    if(fd1[0]>fd2[0]) return true;
    if(fd1[0]<fd2[0]) return false;
    if(fd1[1]>fd2[1]) return true;
    if(fd1[1]<fd2[1]) return false;
    if(fd1[2]>=fd2[2]) return true;
    if(fd1[2]<fd2[2]) return false;  
}

revertDate = date => {
    return date.split("/")[2] + "-" + date.split("/")[1] + "-" + date.split("/")[0];
}