# PHP Rest API

1 - Veritabanı Ayarının Yapılması (config > database.php)

```code
    private $host = "localhost";
    private $database_name = "ornekveritabaniadi";
    private $username = "root";
    private $password = "";
```

2 - Ürün Tablosunun Oluşturulması

```code
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

3 - Örnek Verilerin Tabloya Eklenmesi (İsteğe Bağlı)

```code
INSERT INTO `products` (`product_id`, `name`, `stock`, `created_date`) VALUES
(1, 'Test Product 1', 100, '2020-07-02 22:15:50'),
(2, 'Test Product 2', 15, '2020-07-02 22:16:12'),
(3, 'Test Product 3', 50, '2020-07-02 22:16:22');
```

Not : İsteğe bağlı 2. ve 3. adımları yapmak yerine direk **restapi.sql** dosyasını da içeri aktarabilirsiniz.

## API Rotaları
* `GET - http://hostname/stocks` Tüm Ürün Kayıtları
* `POST - http://hostname/stocks` Yeni Ürün Oluşturma

## Request & Response
```code
`GET Request` http://hostname/stocks 
```

```code
`GET Response`
{
    "code": 0,
    "msg": "success",
    "data": [
        {
            "product_id": "1",
            "name": "Test Product 1",
            "stock": "100",
            "created_date": "2020-07-03 01:15:50"
        },
		...
    ]
}
```

```code
`POST Request` - http://hostname/stocks
{
    "product_id" : "10",
    "name" : "Test Product 1",
    "stock" : "100",
    "created_date" : "2020-07-03 01:15:50"
}
```

```code
`POST Response`
{
    "code": 0,
    "msg": "success",
    "data": {
            "product_id": "1",
            "name": "Test Product 1",
            "stock": "100",
            "created_date": "2020-07-03 01:15:50"
        }
    ]
}
```