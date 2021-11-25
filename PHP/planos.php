<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Green Gate | Planos</title>

    <style type="text/css">
        *{
            padding: 0;
            margin: 0;
            font-family: Caviar Dreams;
            text-align: center;
        }
        section{
            width: 100%;
            height: 90%;
            position: absolute;
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .planos{
            height: 89%;
            width: 22%;
            background-color: #FFF;
            margin: 20px;
            position: relative;
            top: 1.5%;
        }

        .cifrao{
            font-size: 20px;
            position: relative;
            right: 70px;
        }

        .preco_plano{
            font-size: 50px;
        }

        .preco{
            position: absolute;
            width: 100%;
            height: 52%;
            right: 0;
            top: 0;
            padding-top: 22px;
            line-height: 40px;
            border-bottom: 0.1px solid #ebebeb;
        }

        .preco span{
            position: relative;
            top: 14px;
            display: block;
        }

        .descricao{
            position: absolute;
            width: 100%;
            height: 43.5%;
            top: 291px;
            line-height: 40px;
        }

        .descricao p{
            position: relative;
            top: 20px;
            font-size: 15px;
        }

        h2{
            padding-top: 30px;
            font-size: 168%;
        }

        h3{
            font-size: 138%;
        }

        button{
            width: 70%;
            height: 15%;
            border-radius: 20px;
            position: relative;
            background-color: #f4f9b7;
            border: 0;
        }
    </style>
    </head>

    <body bgcolor="#f9fdc5">

    <h2>Escolha o seu Plano!</h2>  

        <section>
            <article class="planos">
                <div class="preco">
                    <h3>Plano Simples</h3>
                    <p class="cifrao">R$</p>
                    <p class="preco_plano">0</p>
                    <span>Perfeito para iniciantes</span>
                    <button style="top: 48px;">Adquira agora</button>
                </div>

                <div class="descricao">
                    <p>Totalmente gratuito</p>
                    <p>Adicionar produtos infinitamente</p>
                </div>
            </article>

            <article class="planos">
                <div class="preco">
                    <h3>Plano Avançado</h3>
                    <p class="cifrao">R$</p>
                    <p class="preco_plano">10</p>
                    <span style="line-height:27px; padding: 0 35px;">Divulgação da sua marca na plaltaforma</span>
                    <button style="top: 34px;">Adquira agora</button>
                </div>

                <div class="descricao">
                    <p>Preço acessível</p>
                    <p>Adicionar produtos infinitamente</p>
                    <p style="line-height:27px; padding: 0 35px; display:block;">Divulgação da marca na plataforma</p>             
                </div>
            
            </article>
        </section>
    </body>
</html>