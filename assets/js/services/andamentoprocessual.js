const inputRazaoSocial = document.getElementById("inputRazaoSocial");
const url = new URL("https://api.escavador.com/api/v1/busca");

let params = {
    "q": inputRazaoSocial,
    "qo": "t",
    "limit": "60",
    "page": "1",
};

Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTJlMzdkNTNmNGIxNTk5ZGE5YWZkN2FkYTQ1YzczZjFmNmRmYWMxOTVmNjgwN2RiNWE1Mjk1YzgzODVmZTFiYmFhYTExZWUwMmNlODM4NTMiLCJpYXQiOjE2NTkxNTIyODksIm5iZiI6MTY1OTE1MjI4OSwiZXhwIjoxOTc0NzcxNDg5LCJzdWIiOiIxMjI4NjM5Iiwic2NvcGVzIjpbImFjZXNzYXJfYXBpX3BhZ2EiXX0.m5vfVNhmRndktabFdEzepw7n6h1I5wCb-jQyi6YltSRbWreQyZpU-fe2_c1GJzEQbJrTfWkcuHi3PpY7XV200CK7IJpPBeDhwMEsfQL6XrZJFCdI4XV4opdP0rO4w_RArGcZYF2A3As8qIUYh2t9jyPA3DLLUtKNPG14Q6GsU8duoUPSQjiKrY8OMGZy2XmvYmEJsecY58Q2YThC3_Ij0kuhzMeoyAPThYLZcoDSrkS2FhUYr3O07iffLaQ_YDtm4cQhg7R6FMMDqzjXJ-td0d37bdjwj7eONbQmVrPP1Zz3CW002n0ZeRtCikKPSl97bnnbpWeQews6EYnV6oyJK5NdtyXrjAPd1JKAdEBd1OcvB-C32NeOR-F8sIUncOK2B9JtGlmfFZEl-lDp22LqGjiAyh67Vhdh2TVVzrGpjsj4boUtsFUckXZz2LL9wBgiXZrWzYDI90hoy5aT4t5VSr5uvdPLAE69wGsG3VRBWzY5zVzCCBgmc5do61ugPQ5bcdICiAHGkdNOd7IKCtfMF0RND99G4hyqeQ9CYhap0qT9o3HZS68VMskvBTBLOvTEc7pWWyAnURUoKs9BdKnkNIHmFLY1l_hzSpb3b3TP9gyecYa6iI0M7YUfDbNwVAGbiBUK17X_CW9vzFs9OmAynGBKu6cj_hff-QAGwMkRF9o",
    "X-Requested-With": "XMLHttpRequest",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));