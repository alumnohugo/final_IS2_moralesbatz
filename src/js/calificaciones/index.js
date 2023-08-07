import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form')
const tablaCalificaciones = document.getElementById('tablaCalificaciones');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true
btnModificar.parentElement.style.display = 'none'
btnCancelar.disabled = true
btnCancelar.parentElement.style.display = 'none'

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['calificacion_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        })
        return
    }

    const body = new FormData(formulario)
    body.delete('calificacion_id')
    const url = '/final_IS2_moralesbatz/API/calificaciones/guardar';
    const headers = new Headers();
    headers.append("X-Requested-With","fetch");
    const config = {
        method: 'POST',
                body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log(data);
        // return;

        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const buscar = async () => {



    // let materia_asignada = formulario.calificacion_asignacion;
    // let alumno_nacionalidad = formulario.alumno_nacionalidad.value;
    
    const url = `/final_IS2_moralesbatz/API/calificaciones/buscar?calificacion_asignacion=${formulario.calificacion_asignacion.value}`;
    const headers = new Headers();
    headers.append("X-Requested-With","fetch");
    const config = {
        method: 'GET'
    }
    
    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        //  console.log(data);
        // return
        
        tablaCalificaciones.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment();
        if (data.length > 0) {
            let contador = 1;
            data.forEach(calificacion => {
                // CREAMOS ELEMENTOS
                const tr = document.createElement('tr');
                const td1 = document.createElement('td')
                const td2 = document.createElement('td')
                const td3 = document.createElement('td')
                const td4 = document.createElement('td')
                const td5 = document.createElement('td')
                const td6 = document.createElement('td')
                const td7 = document.createElement('td')
                const buttonModificar = document.createElement('button')
                const buttonEliminar = document.createElement('button')

                // CARACTERISTICAS A LOS ELEMENTOS
                buttonModificar.classList.add('btn', 'btn-warning')
                buttonEliminar.classList.add('btn', 'btn-danger')
                buttonModificar.textContent = 'Modificar'
                buttonEliminar.textContent = 'Eliminar'

                buttonModificar.addEventListener('click', () => colocarDatos(calificacion))
                buttonEliminar.addEventListener('click', () => eliminar(calificacion.calificacion_id))

                td1.innerText = contador;
                td2.innerText = calificacion.alumno_nombre;
                td3.innerText = calificacion.materia_asignada;
                td4.innerText = calificacion.calificacion_punteo;
                td5.innerText = calificacion.calificacion_resultado;
               
             
                


                // ESTRUCTURANDO DOM
                td6.appendChild(buttonModificar)
                td7.appendChild(buttonEliminar)
                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)
                tr.appendChild(td4)
                tr.appendChild(td5)
                tr.appendChild(td6)
                tr.appendChild(td7)
                


                fragment.appendChild(tr);

                contador++;
            })
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td')
            td.innerText = 'No existen registros'
            td.colSpan = 4
            tr.appendChild(td)
            fragment.appendChild(tr);
        }
        tablaCalificaciones.tBodies[0].appendChild(fragment)

    } catch (error) {
        console.log(error);
    }
}

const colocarDatos = (datos) => {
    console.log(datos)
    formulario.calificacion_asignacion.value = datos.alumno_nombre
    formulario.calificacion_asignacion.value = datos.materia_asignada
    formulario.calificacion_punteo.value = datos.calificacion_punteo
    formulario.calificacion_resultado.value = datos.calificacion_resultado
    formulario.calificacion_id.value = datos.calificacion_id

    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''
    divTabla.style.display = 'none'

    // modalEjemploBS.show();
}

const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
}

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        alert('Debe llenar todos los campos');
        return
    }

    const body = new FormData(formulario)
    const url = '/final_IS2_moralesbatz/API/calificaciones/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With","fetch");
    const config = {
        method: 'POST',
        body
    }

    try {
        // fetch(url, config).then( (respuesta) => respuesta.json() ).then(d => data = d)
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        //    console.log(data);
        //    return;

        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (id) => {
    if (await confirmacion('warning', 'Desea elminar este registro?')) {
        const body = new FormData()
        body.append('calificacion_id', id)
        const url = '/final_IS2_moralesbatz/API/calificaciones/eliminar';
        const headers = new Headers();
        headers.append("X-Requested-With","fetch");
        const config = {
            method: 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();
            // console.log(data);
            // return;


            const { codigo, mensaje, detalle } = data;
            let icon = 'info'
            switch (codigo) {
                case 1:
                    // formulario.reset();
                    icon = 'success'
                    buscar();
                    // cancelarAccion();
                    break;

                case 0:
                    icon = 'error'
                    console.log(detalle)
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            })




        } catch (error) {
            console.log(error);
        }
    }
}
buscar();
formulario.addEventListener('submit', guardar)
 btnBuscar.addEventListener('click', buscar)
btnCancelar.addEventListener('click', cancelarAccion)
btnModificar.addEventListener('click', modificar)

