# User-Panel

How to make a request to the API
```
localhost:3000/server/api?type=login&username=%USERNAME%&password=%PASSWORD%
```
It returns JSON of either
{"result":"success"}
OR
{"result":"Failure"}
```
localhost:3000/server/api?type=getuid&username=%USERNAME%
```
It returns JSON of either
{"result":"INT"}
OR
{"result":"Failure"}


Feel free to open issues.
