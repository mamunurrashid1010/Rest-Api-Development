# Rest Api Development with Passport Authentication

<b>Rest Api Development</b> project, i developed Rest-API using laravel 8 and laravel passport use for api authentication.
 
## How to Install and Run the Project

1. ```git clone https://github.com/mamunurrashid1010/Rest-Api-Development.git```
2. ```cd Rest-Api-Development```
3. ```composer install```
3. Copy ```.env.example``` to ```.env```
4. ```php artisan serve```
5. You can see the project on ```127.0.0.1:8080```

##### Create a Database:
Create a database, here I'm using my XAMPP PHPMyAdmin Database to create a database.<br>
* Open ``` .env ``` file and add your database credentials.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rest_api
DB_USERNAME=root
DB_PASSWORD=
```

## Usage
##### GET: Get All Users Details
```
http://127.0.0.1:8000/api/users
```
###### Response samples
```
{
    "users": [
        {
            "id": 1,
            "name": "Anisul Karim Hossain",
            "email": "anis@gmail.com",
            "email_verified_at": null,
            "created_at": null,
            "updated_at": "2022-10-13T04:17:52.000000Z"
        },
        {
            "id": 2,
            "name": "Karim",
            "email": "karim@gmail.com",
            "email_verified_at": null,
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 3,
            "name": "Hasan",
            "email": "hasan@gmail.com",
            "email_verified_at": null,
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 9,
            "name": "kamal",
            "email": "kamal@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-10-17T05:21:05.000000Z",
            "updated_at": "2022-10-17T06:09:30.000000Z"
        }
    ]
}
```

##### GET: Get Single User Details
```
http://127.0.0.1:8000/api/users/1
```
###### Response samples
```
{
    "users": {
        "id": 1,
        "name": "Anisul Karim Hossain",
        "email": "anis@gmail.com",
        "email_verified_at": null,
        "created_at": null,
        "updated_at": "2022-10-13T04:17:52.000000Z"
    }
}
```

##### POST: Add Single User
```
http://127.0.0.1:8000/api/addUser
```
###### Body:form-data
```
key:    name   
value:  Arif Hossain Chy
key:    email
value:  arifChy@gmail.com
key:    password
value:  12345
```
###### Response samples
```
{
    "message": "User Create Successfully"
}
```


##### POST: Add Multiple Users
```
http://127.0.0.1:8000/api/addMultipleUsers
```

###### Body:Json
```
{
    "users":[
        {
            "name":"belal",
            "email":"belal@gmail.com",
            "password":12345
        },
        {
            "name":"jakir",
            "email":"jakir@gmail.com",
            "password":12345
        }
    ]
}
```
###### Response samples
```
{
    "message": "User Create Successfully"
}
```

##### PUT: Update User Details
```
http://127.0.0.1:8000/api/updateUserDetails/1
```

###### Body:Json
```
{
    "name":"Anisul Karim Hossain",
    "password":"12345"
}
```
###### Response samples
```
{
    "message": "User Update Successfully"
}
```

##### DELETE: Delete Single User
```
http://127.0.0.1:8000/api/deleteUser/12
```
or
```
http://127.0.0.1:8000/api/deleteUser
```

###### Body:Json
```
{
    "id":12
}
```
###### Response samples
```
{
    "message": "User Delete Successfully"
}
```

##### DELETE: Delete Multiple Users
```
http://127.0.0.1:8000/api/deleteMultipleUser
```

###### Body:Json
```
{
    "ids":[
        {
            "id":10
        },
        {
            "id":11
        }
    ]
}
```
###### Response samples
```
{
    "message": "User Delete Successfully"
}
```

##### POST: User Registration Using Passport
```
http://127.0.0.1:8000/api/userRegistrationUsingPassport
```

###### Body:form-data
```
key:    name   
value:  Kamal Hossain Chy
key:    email
value:  kamalH@gmail.com
key:    password
value:  12345
```

###### Response samples
```
{
    "message": "User Successfully Registered",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiM2UzODVjZGVhN2QwMGQ3NWQ0OTkwMjliOTNiMjdjNzg1YjkzNTk0ODVhMWI5NTY2ZDFlODg5ZmZiZDFiODI0MWQzYTY3MGFhZjlkYTg3ZTUiLCJpYXQiOjE2NjYwNzEzNDcuMzA3NzY1LCJuYmYiOjE2NjYwNzEzNDcuMzA3NzcyLCJleHAiOjE2OTc2MDczNDcuMjM5MjQzLCJzdWIiOiIxMyIsInNjb3BlcyI6W119.RELNxNF3p0mGxwskrlCUZSKnEmjlHgVWGbI015rbECzy0yh29IwCZqjMPdtBu5hOlg2agiahkORwB1CJpy6UDxseNSg3hVDksAJxtVAI1_IYmT9A4pEQuVllhLCjTDrOMTZvqkiKg1FuWKYos7AU-wQap-3hr3ymRoanSBovqEO_qhHjLlf_SMo4QrdIJWFIOLVm7Px_bW6dnWwa8MO5m7GkUr0lOsmSMPEYPXHMvmaBdR_YPx387oLpOcJqee-91WyCEEytK11HTql3sUnCg-vDs7VA1dlUQf2nTUKY2R_e760JOYMiibSRrn_QLL_889Us-e17W8bePp-k0Tub35gngVIGB3B5pQmJn32wyGqhZLtHw3pm_Iw4yEsF8PHdfm8ksWKfQ7n5qZlFHRUflDNv3aqFylpLMCn2j0OhHIj-6mA8Ztw8yjr4epvYaPPJXixfjq-PWxED4OWLDrFZdjhzfpzkqw6ZF-hDxlBRAK9kUENQCTMhEht_QcJdcedcn74ttrgvZ6I3a_8lsgsOycht-opKvEmKedgvmz3A-tdaO6212xIXtToinPkBz-Sc5Ct-mwI2VuR8r_uLMwEAQ18lIIYEbDLyoARDmpnyQCnxqe5lymtHVRujQUSGDGdQd96UpHR6ikIGPFcfKJ_sH7keBYBywErSVez16bSg7Yo"
}
```

##### POST: User Login Using Passport Authentication
```
http://127.0.0.1:8000/api/userLoginUsingPassport
```

###### Body:form-data
```
key:    email
value:  kamalH@gmail.com
key:    password
value:  12345
```

###### Response samples
```
{
    "message": "User Successfully Login",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDNiZDQzNzFhM2ZlMDI5OTFkYWQ0NWUzNTU1YTExY2I2NzEwOTMxOTZiYmMxYzdjY2U1NDE1MGI0ZjEzMDJiOWM1ODc2YzNjN2Q2ZDk2NzciLCJpYXQiOjE2NjYwNzE2MTguNDI3MTkxLCJuYmYiOjE2NjYwNzE2MTguNDI3MTk3LCJleHAiOjE2OTc2MDc2MTguNDE5MDczLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.AA969lDjyNq85UCfxqVCG3lBlda2SwIR5xMgyG5gjMg8nglBx0sehNgZ9Mu2hSTYXP2lAd4kYTpNrIwTpj7OHaBryPEbPKfSb-wCZaBGcMBz5JDVuukhiFX_-CzLiumIv26LL0vR-lSk5BoX6cq7yXP5okn7xZOUXTr63wZFCcy6aUSad73LRLs1Vlkiowkpx-GCjxJMfhMfTRVZzIAOtxwTBaQz5XYGs07PX3SQshUJi2mDtLjNIK-Q3ZgSzGi0DREG1q5xKPXctPQA9DhP3iYl4r02MdK_QxIjwsQRX_98t-CXDW6q0aw40IDwdefybJ9DEEiv-RmTgiKNqJgoIDBJQ0OnBgbs7Mb7AhJ8sAnTvsErsajkJYpbTLVCg1m8Lt7pK1utC5jHHeDK-22ZzuwV7OE_J-3w4UvgnK1lhvT2yN3k6CFqelHbQREdFwFbndo5ZfCCQAWVNVGjloJVmIBtFq8pNrmXgY5qvt1ZXdEfqwjdyx5BHzm-5LrTUMXu4Qbkez0lVGX-w3rdcA2GSO-Hjg_0d1hocWS8B2cYlatvXQFuLx-UXHtmYOfHFOky8iV36puci6zfJLX5NJTkZCFORNfgXjpPjiF_6Fr93dI7VypoqkGi4MwYQqpgriHkvOMjw9Wsg-Zyn2nQhKFKdVqSXX73mgDsqK0nyfhtLd0"
}
```
