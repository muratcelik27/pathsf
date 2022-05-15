# Symfony Jwt Tabanlı Rest Api Örneği 
##### 1) Manuel Kullanıcı Oluşturma
```http
GET http://localhost/pathsf/public/sign/up
```
##### Cevap
```json
{
  "message" : "Kullanıcı Oluşturma İşlemi Başarılı",
  "email": "murat@murat.com",
  "password":"123456",
}
```
##### 2) Kullanıcı Girişi
```http
POST http://localhost/pathsf/public/sign/in
```

```json
{
  "email": "murat@murat.com",
  "password":"123456",
}
```
##### Cevap
```json
{
    "message": "Giriş İşlemi Başarılı",
    "token": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoibXVyYXRAbXVyYXQuY29tIiwiZXhwIjoxNjU1MjI4MjQxfQ.QYKzHm39EyynM52dpUkwso-Lnr7HrVZ7U3kN2CGWTHU"
}
```
Yapılacak İsteklerin Header Kısmına Eklenecek Değer 
```
Authorization : "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoibXVyYXRAbXVyYXQuY29tIiwiZXhwIjoxNjU1MjI4MjQxfQ.QYKzHm39EyynM52dpUkwso-Lnr7HrVZ7U3kN2CGWTHU"
```
##### 2) Sipariş Oluşturma
```http
POST http://localhost/pathsf/public/order/create
```
```json
{
	"productId":1,
	"quantity":5,
	"address":"Burası bir örnek adres"
}
```
##### Cevap
```json
{
    "message": "Siparişiniz Başarılı Bir Şekilde Oluşturuldu"
}
```

##### 2) Sipariş Güncelleme
```http
POST http://localhost/pathsf/public/order/edit
```
```json
{
	"quantity":3,
	"address":"Burası bir adres değişti"
}
```
##### Cevap
```json
{
    "message": "Siparişiniz Güncellendi"
}
```

##### 2) Sipariş Listeleme
```http
GET http://localhost/pathsf/public/order/list
```

##### Cevap
```json
[
    {
        "user": {
            "id": 1,
            "email": "murat@murat.com",
            "userIdentifier": "murat@murat.com",
            "username": "murat@murat.com",
            "roles": [
                "ROLE_USER"
            ],
            "password": "$2y$13$s7ikynRyeGr2vxQXBvkUAuv7dujnEqcD3AXZg9sP38ISwHNzPljVK",
            "salt": null
        },
        "product": {
            "__initializer__": [],
            "__cloner__": [],
            "__isInitialized__": false
        },
        "id": 1,
        "orderCode": "3ZB7w8",
        "quantity": 5,
        "address": "Burası bir adres",
        "shippingDate": "2022-05-19T19:51:53+00:00"
    },
    {
        "user": {
            "id": 1,
            "email": "murat@murat.com",
            "userIdentifier": "murat@murat.com",
            "username": "murat@murat.com",
            "roles": [
                "ROLE_USER"
            ],
            "password": "$2y$13$s7ikynRyeGr2vxQXBvkUAuv7dujnEqcD3AXZg9sP38ISwHNzPljVK",
            "salt": null
        },
        "product": {
            "__initializer__": [],
            "__cloner__": [],
            "__isInitialized__": false
        },
        "id": 6,
        "orderCode": "L1VUMz",
        "quantity": 5,
        "address": "Burası bir örnek adres",
        "shippingDate": "2022-05-20T17:46:58+00:00"
    }
]
```

##### 2) Sipariş Deay
```http
GET http://localhost/pathsf/public/order/show/1
```

##### Cevap
```json
{
    "user": {
        "id": 1,
        "email": "murat@murat.com",
        "userIdentifier": "murat@murat.com",
        "username": "murat@murat.com",
        "roles": [
            "ROLE_USER"
        ],
        "password": "$2y$13$s7ikynRyeGr2vxQXBvkUAuv7dujnEqcD3AXZg9sP38ISwHNzPljVK",
        "salt": null
    },
    "product": [],
    "id": 1,
    "orderCode": "3ZB7w8",
    "quantity": 5,
    "address": "Burası bir adres",
    "shippingDate": "2022-05-19T19:51:53+00:00"
}
```