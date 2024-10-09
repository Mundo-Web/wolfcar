<?php

namespace App\Http\Responses;

use App\Helpers\EmailConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;


class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {
        $role = Auth::user()->roles->pluck('name');
        $usuario = Auth::user();
        
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role[0]) {
            case 'Admin':
                return redirect()->intended(config('fortify.home'));
            case 'Customer':
                $this-> envioCorreo($usuario);
                return redirect()->intended(config('fortify.home_public'));
            default:
                return redirect()->intended(config('fortify.home_public'));
        }
    }



    private function envioCorreo($data){
        
        $appUrl = env('APP_URL');
        $name = $data['name'];
        $mensaje = "Gracias por registrarse en ".env('APP_NAME');
        $mail = EmailConfig::config($name, $mensaje);
        try {
          $mail->addAddress($data['email']);
          $mail->Body = '<html lang="es">
            <head>
              <meta charset="UTF-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1.0" />
              <title>Mundo web</title>
              <link rel="preconnect" href="https://fonts.googleapis.com" />
              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
              <link
                href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
                rel="stylesheet"
              />
              <style>
                * {
                  margin: 0;
                  padding: 0;
                  box-sizing: border-box;
                }
              </style>
            </head>
            <body>
              <main>
                <table
                  style="
                    width: 600px;
                    height: 800px;
                    margin: 0 auto;
                    text-align: center;
                    background-image:url(' . $appUrl . '/mail/fondo.png);
                    background-repeat: no-repeat, no-repeat;
                    background-size: fit , fit;
                    background-color: #f9f9f9;
                  "
                >
                  <thead>
                    <tr>
                      <th
                        style="
                          display: flex;
                          flex-direction: row;
                          justify-content: center;
                          align-items: center;
                          margin: 40px;
                        "
                      >
                        <img src="' . $appUrl . '/mail/logo.png" alt="Wolfcar"  style="
                        margin: auto;
                      "/>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="height: 10px">
                        <p
                          style="
                            color: #FD1F4A;
                            font-weight: 500;
                            font-size: 18px;
                            text-align: center;
                            width: 500px;
                            margin: 0 auto;
                            font-family: Montserrat, sans-serif;
                            line-height: 30px;
                          "
                        >
                          <span style="display: block">Felicidades </span>
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td style="height: 10px">
                        <p
                          style="
                            color: #111111;
                            font-size: 40px;
                            font-family: Montserrat, sans-serif;
                            font-weight: bold;
                            line-height: 60px;
                          "
                        >
                          ¡Gracias por registrarte!
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td style="height: 10px">
                        <p
                          style="
                            color: #111111;
                            font-weight: 500;
                            font-size: 18px;
                            text-align: center;
                            width: 400px;
                            margin: 0 auto;
                            font-family: Montserrat, sans-serif;
                            line-height: 30px;
                          "
                        > Hola ' . $name . ' <br>
                          <span >Ya puedes realizar compras en nuestra tienda.</span>
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td
                        style="
                        text-align: center;
                        vertical-align: baseline;
                        padding-top:20px;
                      "
                      >
                        <a
                          href="' . $appUrl . '"
                          style="
                            text-decoration: none;
                            background-color: #FD1F4A;
                            color: white;
                            padding: 16px 12px;
                            display: inline-flex;
                            justify-content: center;
                            align-items: start;
                            gap: 10px;
                            font-weight: 600;
                            font-family: Montserrat, sans-serif;
                            font-size: 16px;
                            border-radius: 10px;
                          "
                        >
                          <span>Visita nuestra web</span>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </main>
            </body>
          </html>
          ';
          // $mail->addBCC('atencionalcliente@boostperu.com.pe', 'Atencion al cliente', );
          // $mail->addBCC('jefecomercial@boostperu.com.pe', 'Jefe Comercial', );
          $mail->isHTML(true);
          $mail->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
}

}