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
POST http://localhost/pathsf/public/order/sign/create
```
Request Header 
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

