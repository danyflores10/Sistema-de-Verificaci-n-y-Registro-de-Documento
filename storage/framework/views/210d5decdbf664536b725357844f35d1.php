<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Verificación</title>
</head>
<body style="margin: 0; padding: 0; background-color: #eef1f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #eef1f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.10);">

                    <?php
                        $logoPath = public_path('images/logoCorreos.png');
                        $logoSrc = isset($message) ? $message->embed($logoPath) : asset('images/logoCorreos.png');
                    ?>

                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #0c2340 0%, #15325a 50%, #0c2340 100%); padding: 36px 40px 28px 40px; text-align: center;">
                            <img src="<?php echo e($logoSrc); ?>" alt="Agencia Boliviana de Correos" width="160" style="display: block; margin: 0 auto 16px auto; max-width: 160px; height: auto;">
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; letter-spacing: 1.5px;">AGENCIA BOLIVIANA</h1>
                            <p style="color: #f4b223; font-size: 13px; font-weight: 600; margin: 6px 0 0 0; letter-spacing: 4px;">DE CORREOS</p>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="height: 4px; background: linear-gradient(90deg, #f4b223, #e09800, #f4b223);"></td>
                    </tr>

                    
                    <tr>
                        <td style="padding: 44px 40px 36px 40px;">
                            <h2 style="color: #1f2937; font-size: 22px; font-weight: 700; margin: 0 0 8px 0; text-align: center;">Código de Verificación</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.7; margin: 0 0 30px 0; text-align: center;">
                                Ha solicitado restablecer su contraseña. Use el siguiente código para continuar:
                            </p>

                            
                            <div style="text-align: center; margin: 0 0 30px 0;">
                                <table role="presentation" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="background: linear-gradient(135deg, #0c2340, #1a365d); border-radius: 14px; padding: 22px 44px; text-align: center;">
                                            <span style="font-size: 38px; font-weight: 800; letter-spacing: 14px; color: #f4b223; font-family: 'Courier New', monospace;"><?php echo e($code); ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <p style="color: #6b7280; font-size: 13px; line-height: 1.6; margin: 0 0 8px 0; text-align: center;">
                                Este código expira en <strong style="color: #c8102e;">5 minutos</strong>.
                            </p>
                            <p style="color: #9ca3af; font-size: 12px; line-height: 1.6; margin: 0; text-align: center;">
                                Si usted no solicitó este código, ignore este mensaje. Su cuenta permanece segura.
                            </p>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="padding: 0;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #0c2340 0%, #15325a 100%); border-radius: 0 0 16px 16px;">
                                <tr>
                                    <td style="padding: 28px 40px; text-align: center;">
                                        <img src="<?php echo e($logoSrc); ?>" alt="AGBC" width="48" style="display: block; margin: 0 auto 12px auto; max-width: 48px; height: auto; opacity: 0.85;">
                                        <p style="color: #d1d5db; font-size: 12px; margin: 0 0 6px 0; font-weight: 500;">&copy; <?php echo e(date('Y')); ?> Agencia Boliviana de Correos</p>
                                        <p style="color: #8b95a5; font-size: 11px; margin: 0 0 14px 0;">Sistema de Verificación y Registro de Documentos</p>
                                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                            <tr>
                                                <td style="height: 1px; width: 60px; background-color: #2a4a6b;"></td>
                                            </tr>
                                        </table>
                                        <p style="color: #6b7a8d; font-size: 10px; margin: 12px 0 0 0; line-height: 1.5;">Este correo fue enviado automáticamente.<br>Por favor, no responda a este mensaje.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\emails\password-reset-code.blade.php ENDPATH**/ ?>