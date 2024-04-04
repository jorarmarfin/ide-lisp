
# Editor de Código Lisp con CodeMirror

Este proyecto implementa un editor de código en la web para el lenguaje Lisp, utilizando la biblioteca CodeMirror. El editor proporciona características útiles como resaltado de sintaxis, cierre automático de paréntesis y la capacidad de ejecutar código Lisp directamente desde el navegador.

## Características

- **Resaltado de Sintaxis**: Soporte para resaltado de sintaxis de Lisp para mejorar la legibilidad del código.
- **Cierre Automático de Paréntesis**: Mejora la escritura de código al cerrar automáticamente paréntesis, corchetes y llaves.
- **Ejecución de Código**: Permite la ejecución de código Lisp y muestra los resultados directamente en el navegador.
- **Descarga de Código**: Posibilidad de descargar el código escrito como un archivo `.txt`.

## Inicio Rápido

Para utilizar este editor, simplemente clona el repositorio en tu servidor local o remoto y abre el archivo `index.html` en tu navegador.

```bash
git clone https://github.com/jorarmarfin/ide-lisp
cd tuEditorCodeMirror
```

Abre `index.html` en tu navegador para comenzar a usar el editor.

## Dependencias

Este proyecto depende de CodeMirror para la funcionalidad del editor. Asegúrate de incluir CodeMirror y los siguientes addons en tu proyecto:

- `codemirror/lib/codemirror.css`
- `codemirror/lib/codemirror.js`
- `codemirror/mode/scheme/scheme.js` (para el resaltado de sintaxis de Lisp)
- `codemirror/addon/edit/closebrackets.js` (para el cierre automático de paréntesis)

## Configuración

Para personalizar el editor, modifica las opciones de configuración en el script de inicialización de CodeMirror dentro de `index.html`. Puedes ajustar el modo (`mode`), tema (`theme`), y otras opciones según necesites.

## Seguridad

Este editor ejecuta código Lisp directamente en el servidor. Asegúrate de implementar las medidas de seguridad adecuadas para evitar la ejecución de código malicioso.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir, por favor haz un fork del repositorio, haz tus cambios y envía un pull request.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo `LICENSE.md` para más detalles.
