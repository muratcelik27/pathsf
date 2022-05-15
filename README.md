# Symfony Jwt Tabanlı Rest Api Örneği 
##### Manuel Kullanıcı Oluşturma
```http
GET http://localhost/pathsf/public/api/sign/up
```
#####Cevap
```json
{
  "message" : "Kullanıcı Oluşturma İşlemi Başarılı",
  "email": "murat@murat.com",
  "password":"123456",
}
```
##### Kullanıcı Girişi
```http
POST http://localhost/pathsf/public/api/sign/in
```
```json
{
  "email": "murat@murat.com",
  "password":"123456",
}
```
#####Cevap
```json
{
    "message": "Giriş İşlemi Başarılı",
    "token": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoibXVyYXRAbXVyYXQuY29tIiwiZXhwIjoxNjU1MjI4MjQxfQ.QYKzHm39EyynM52dpUkwso-Lnr7HrVZ7U3kN2CGWTHU"
}
```

