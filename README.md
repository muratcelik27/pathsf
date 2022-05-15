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
POST http://localhost/pathsf/public/api/order/create
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
POST http://localhost/pathsf/public/api/order/edit
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
GET http://localhost/pathsf/public/api/order/list
```

##### Cevap
```json
[
    {
        "id": 1,
        "orderCode": "LsPVsq",
        "quantity": 5,
        "address": "Burası bir örnek adres",
        "shippingDate": "2022-05-20T18:29:53+00:00",
        "product": {
            "id": 1,
            "name": "Telefon",
            "price": 100
        },
        "user": {
            "id": 1,
            "email": "murat@murat.com",
            "roles": [
                "ROLE_USER"
            ],
            "password": "$2y$13$u2UbXX23hEI6aW/1JcfyXuTSWXNMFq14a1sCpWJk9oihvOUGi2jF6"
        }
    }
]
```

##### 2) Sipariş Deay
```http
GET http://localhost/pathsf/public/api/order/show/1
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
        "password": "$2y$13$u2UbXX23hEI6aW/1JcfyXuTSWXNMFq14a1sCpWJk9oihvOUGi2jF6",
        "salt": null
    },
    "product": {
        "id": 1,
        "name": "Telefon",
        "price": 100
    },
    "id": 1,
    "orderCode": "LsPVsq",
    "quantity": 5,
    "address": "Burası bir örnek adres",
    "shippingDate": "2022-05-20T18:29:53+00:00"
}
```