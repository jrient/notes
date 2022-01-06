### 免费条码生成接口
> https://barcode.tec-it.com/barcode.ashx
> method:POST

参数：

|参数 | 类型 | 说明 |
| -- | -- | -- |
| data | string | 数据 推荐ABC-abc-1234格式|
| code | string | 条码类型Code128 |
| base64 | bool | 是否base64,请填true|

条码类型 

| 值 | 说明 |
| -- | -- |
| Code128 | 推荐 |
| Code11 | |
| Code25IL | Code2of5 Interleaved |
| Code39 | |
| Code39FullASCII | Code39全ASCII码 |
| Code93 | |
| Flattermarken | |
| EANUCC128 | GS1-128 (UCC/EAN-128) |
| MSI | |
| OneTrackPharmacode | Pharmacode One-Track |
| TwoTrackPharmacode | Pharmacode Two-Track|
| TelepenAlpha | |

返回： 图片base64Code字符串

使用：
`data:image/png;base64,`+base64Code
