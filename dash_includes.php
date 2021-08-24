 <style type="text/css">
        @font-face {
            font-family: 'Orbitron';
            font-style: normal;
            font-weight: normal;
            src: local('Orbitron'), url('orbitron/orbitron-v15-latin-regular.woff') format('woff');
        }    
        .calc{
            width: 220px;
            margin: auto;
            background-color:  #39383d;
            padding: 10px;
            border-radius: 8px;
            font-family: Orbitron;
        }
        .display{
            width: 100%;
            height: 40px;
            border:none;
            background-color: #a2af77;
            margin-bottom: 10px;
            border-radius: 4px;
            font-size: 22px;
        }
        input[type=button]{
            width: 46px;
            height: 46px;
            margin: 2px;
            color: #fff;
            border: none;
            border-radius: 2px;
            background-color: #58595b;
            font-size: 18px;
        }
        .notify{
            width: 100px;
            height: 30px; 
            background:green;
            margin-top: 70px;
            float: right;
            text-align: center;
            border-radius: 6px 0px 0px 6px;
            transition: 0.2;
        }
        .notify > span{
            line-height: 30px;
            color: white;
            font-weight: bold;
        }
        .printable{
            z-index: 100;
            height: 200px;
            width: 10%;
            position: absolute;
            margin-top: 20em;
            margin-left: 90%;
            display: none;
            position: fixed;
            overflow-y: scroll;
        }
    
        .printable a{
            color: black;
            font-size: 12px;
            text-decoration: none;
        }
  
</style> 