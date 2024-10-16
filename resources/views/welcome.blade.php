<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
<div class="bg-blue-500 text-white p-4 rounded-lg">
    Hello, Tailwind CSS!
</div>
</body>
</html>
.fui-upload {
    border: 2px dashed #cccccc;
    border-radius: 12px;
    width: 150px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #ffffff;
    transition: border-color 0.3s ease;
    cursor: pointer;
}
.fui-upload:hover {
    border-color: #00aaff;
}
.upload-icon img {
    height: 50px;
}

.fui-upload-text{
    margin-top: 8px;
    font-weight: 500;
    color: #333;
}