export async function asyncGet(filePath){
    return new Promise(function (resolve, reject) {
        let xmlRequest = new XMLHttpRequest();
        xmlRequest.responseType = "text";
        xmlRequest.overrideMimeType("text/xml");

        xmlRequest.addEventListener("readystatechange", function () {
            if(xmlRequest.readyState === 4){
                if(xmlRequest.status === 200){
                    resolve(xmlRequest.responseText);
                }else{
                    reject(new Error("File '"+ filePath +"' could not be loaded!"));
                }

            }
        });

        xmlRequest.open("GET", filePath, true);

        xmlRequest.send();
    });
}

export async function asyncPostWithParms(filePath, parms){
    return new Promise(function (resolve, reject) {
        let xmlRequest = new XMLHttpRequest();
        xmlRequest.responseType = "text";
        xmlRequest.overrideMimeType("text/xml");

        xmlRequest.addEventListener("readystatechange", function () {
            if(xmlRequest.readyState === 4){
                if(xmlRequest.status === 200){
                    resolve(xmlRequest.responseText);
                }else{
                    reject(new Error("File '"+ filePath +"' could not be loaded!"));
                }

            }
        });

        xmlRequest.open("POST", filePath, true);

        xmlRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xmlRequest.send(parms);
    });
}
