import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import swal from 'sweetalert';
import { Modal, Button, Form, Input } from "antd";
import LibraryAddCheckIcon from '@material-ui/icons/LibraryAddCheck';
import CreateIcon from '@material-ui/icons/Create';
import Moment from 'moment';

// Componentes de Conexion con el Backend
import crearordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";
import cumplimientooservServices from "../../../services/GestionOrdenes/CumplimientoOserv";
import equiposServices from "../../../services/Mantenimiento/Equipos";

const { Item } = Form;

// Componentes Adicionales al proceso de Ordenes de Servicio
import ActividadesOservOperario from "../ActividadesOserv/RegistroActividadesOperario";

function NumberFormatCustom(props) {
    const { inputRef, ...other } = props;
    //console.log(inputRef);
    return (
        <NumberFormat
            {...other}
            getInputRef={inputRef}
            thousandSeparator={'.'}
            decimalSeparator={','}

        />
    );
}

function CumplirOrdenTecnico(props) {
    const { tipousuario, idUsu } = props;
    console.log("TIPO USUARIO  : ", tipousuario)
    console.log("USUARIO  : ", idUsu)

    const [listarOrdenes, setListarOrdenes] = useState([]);
    const [ordenServicio, setOrdenServicio] = useState([]);
    const [listActividadActiva, setListActividadActiva] = useState([]);
    const [modalEditar, setModalEditar] = useState(false);
    const [modalOT, setModalOT] = useState(false);
    const [modalPendiente, setModalPendiente] = useState(false);
    const [tipoRegistro, setTipoRegistro] = useState(true);
    const [cambio, setCambio] = useState(false);
    const [totalActivas, setTotalActivas] = useState(1);
    const [Activas, setActivas] = useState(0);
    const [operario, setOperario] = React.useState(0);
    const [operarioDos, setOperarioDos] = React.useState(0);
    const [grabar, setGrabar] = React.useState(false);
    const fechainicial = Moment(new Date()).format('2001-01-01 00:00:00');
    const fechaactual = Moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

    const [ordenSeleccionado, setOrdenSeleccionado] = useState({
        'id_otr': "",
        'estado_otr': "",
        'tipo_otr': "",
        'concepto_otr': "",
        'fechaprogramada_otr': "",
        'fechainicia_otr': "",
        'fechafinal_otr': "",
        'diasoperacion_otr': 0,
        'equipo_otr': "",
        'proveedor_otr': "",
        'cliente_otr': "",
        'operario_otr': "",
        'grupoequipo_otr': "",
        'subgrupoequipo_otr': "",
        'ciudad_otr': "",
        'resumenorden_otr': "",
        'prioridad_otr': "",
        'empresa_otr': ""
    })

    const [cumplimientoSeleccionado, setCumplimientoSeleccionado] = useState({
        id: 0,
        id_cosv: "",
        id_actividad: 0,
        descripcion_cosv: "",
        tipooperacion_cosv: "",
        tipofallamtto_cosv: "",
        referencia_cosv: "",
        cantidad_cosv: "",
        valorunitario_cosv: "",
        valortotal_cosv: "",
        servicio_cosv: 0,
        observacion_cosv: "",
        tiempoactividad_cosv: 0,
        tipo_cosv: "",
        fechaprogramada_cosv: fechaactual,
        fechainicia_cosv: fechainicial,
        fechafinal_cosv: "",
        operario_cosv: operario,
        operariodos_cosv: operarioDos,
        resumenactividad_cosv: "",
        iniciatransporte_cosv: fechainicial,
        finaltransporte_cosv: fechainicial,
        tiempotransporte_cosv: 0,
        horometro_cosv: 0,
        estado_cosv: 23,
        idcomponente: 0,
        seriecomponente: 0,
        voltajecomponente: 0,
        voltajesalidasulfatacion: 0,
        amperajecomponente: 0,
        celdasreferenciacomponente: 0,
        cofreseriecomponentes: 0,
        estadocomponentes: 0,
        estadooperacionequipo_cosv: 81,
    });

    useEffect(() => {
        if (idUsu > 0) {

            if (tipousuario === 11) {
                async function fetchDataOrdenes() {
                    const res = await cumplimientooservServices.leeactividadestecnico(idUsu);
                    setListarOrdenes(res.data);
                    console.log("LEE ORDEN DEL USUARIO : ", res.data);
                }
                fetchDataOrdenes();
            } else {
                async function fetchDataOrdenes() {
                    const res = await cumplimientooservServices.leeactividadestotalactivas();
                    setListarOrdenes(res.data);
                    console.log("Lee Ordenes Automaticas", res.data);
                }
                fetchDataOrdenes();
            }

        }
    }, [idUsu])

    const agregarActividad = (actividad) => {
        //e.preventDefault();
        let activas;
        async function fetchDataTotalActivos() {
            const rest = await cumplimientooservServices.actividadestotalesxot(actividad.id_otr);
            activas = rest.data[0].actividadesxotactivas;
            console.log("TOTAL ACTIVAS : ", rest.data[0].actividadestotalesxot)

            console.log("ACTIVIDAD : ", actividad);

            {
                activas = rest.data[0].actividadestotalesxot + 1;
                let idactividad = "" + actividad.id_otr + activas;
                setCumplimientoSeleccionado([{
                    id: activas,
                    id_cosv: actividad.id_otr,
                    id_actividad: idactividad,
                    descripcion_cosv: "",
                    tipooperacion_cosv: 8,
                    tipofallamtto_cosv: 48,
                    referencia_cosv: 0,
                    cantidad_cosv: 0,
                    valorunitario_cosv: 0,
                    valortotal_cosv: 0,
                    servicio_cosv: actividad.servicio_cosv,
                    observacion_cosv: "",
                    tiempoactividad_cosv: 0,
                    tipo_cosv: 1,
                    fechaprogramada_cosv: fechaactual,
                    fechainicia_cosv: fechainicial,
                    fechafinal_cosv: fechaactual,
                    operario_cosv: operario,
                    operariodos_cosv: operarioDos,
                    resumenactividad_cosv: "",
                    iniciatransporte_cosv: fechainicial,
                    finaltransporte_cosv: fechainicial,
                    tiempotransporte_cosv: 0,
                    horometro_cosv: 0,
                    estado_cosv: 23,
                    idcomponente: 0,
                    seriecomponente: 0,
                    voltajecomponente: 0,
                    voltajesalidasulfatacion: 0,
                    amperajecomponente: 0,
                    celdasreferenciacomponente: 0,
                    cofreseriecomponentes: 0,
                    estadocomponentes: 0,
                    estadooperacionequipo_cosv: 81,
                }])
            }

            setGrabar(true)
        }
        fetchDataTotalActivos();
    };

    useEffect(() => {
        async function crearActividad() {
            if (grabar) {
                console.log("DATOS CREAR ACTIVIDAD : ", cumplimientoSeleccionado[0])

                const res = await cumplimientooservServices.save(cumplimientoSeleccionado[0]);

                if (res.success) {
                    swal("Crear Actividad OT", "Actividad de la OT Creada de forma Correcta!", "success", { button: "Aceptar" });
                    console.log(res.message)
                    window.location.reload();
                } else {
                    swal("Crear actividad OT", "Error Creando la Actividad de la OT!", "error", { button: "Aceptar" });
                    console.log(res.message);
                }
            }
        }
        crearActividad();
    }, [grabar])

    const seleccionarOrden = (orden, caso) => {
        console.log("DATOS ORDEN : ", orden)
        if (orden.estado_otr === 24 || orden.estado_otr === 27 || orden.estado_otr === 32) {
            swal("Cumplimiento OT", "El estado de la OT no permite cambios", "warning", { button: "Aceptar" });
        } else {
            setOrdenServicio(orden);
            setOrdenSeleccionado(orden);
            setCambio(true);
            async function fetchDataCumplimientoActivo() {
                const res = await cumplimientooservServices.listActividadActiva(orden.id_actividad);
                setListActividadActiva(res.data[0]);
                //console.log("DATOS ACTIVIDAD : ", res.data[0])
            }
            fetchDataCumplimientoActivo();

            async function fetchDataTotalActivos() {
                const rest = await cumplimientooservServices.actividadesactivasxot(orden.id_otr);
                setTotalActivas(rest.data[0].actividadesxotactivas);
                //console.log("TOTAL ACTIVAS : ", rest.data[0].actividadesxotactivas)
            }
            fetchDataTotalActivos();

            //console.log("CLIENTE SELECCIONADO : ", listarClientes);
            (caso === "Editar") ? abrirModalEditar() : abrirCerrarModalPendiente()
        }
    }

    const seleccionaotCrearActividad = (orden, caso) => {
        //console.log("DATOS ORDEN : ", orden)
        let creaActividad = "N";

        swal({
            title: "CREAR ACTIVIDAD OT",
            text: "Por favor confirme si desea crear la Actividad!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    agregarActividad(orden);
                } else {
                    return;
                }
            });
    }

    const abrirModalEditar = () => {
        setModalEditar(true);
    }

    const cerrarModalEditar = () => {
        setModalEditar(false);
    }

    const abrirCerrarModalPendiente = () => {
        setModalPendiente(!modalPendiente);
    }

    const abrirCerrarModalOT = () => {
        setModalOT(!modalOT);
    }

    // "string","boolean","numeric","date","datetime","time","currency"
    const columnas = [
        {
            field: 'id_otr',
            title: '#Orden',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'id_actividad',
            title: '#Actividad',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'descripcion_tmt',
            title: 'Tipo Mtto',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'fechaprogramada_otr',
            title: 'Fecha de Programación',
            type: 'date',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'codigo_equ',
            title: 'Equipo',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'razonsocial_cli',
            title: 'Cliente',
            cellStyle: { width: 300, mamWidth: 100 }
        },
        {
            field: 'nombre_ciu',
            title: 'Ciudad',
            cellStyle: { minWidth: 50 }
        },
        {
            field: 'comentarios_cosv',
            title: 'Comentarios',
            cellStyle: { minWidth: 100 }
        }
    ]

    const ordenInsertar = (
        console.log("Insertar")
    )

    const ordenEditar = (
        <div className="App">
            {
                totalActivas > 0 ?
                    (
                        <ActividadesOservOperario ordenSeleccionado={ordenSeleccionado} tipoRegistro={tipoRegistro}
                            listActividadActiva={listActividadActiva} idUsu={idUsu}
                        />
                    )
                    :
                    (
                        swal("Actividades OT", "OT no tiene Actividades Asignadas", "warning", { button: "Aceptar" })
                    )
            }
            {
                totalActivas === 0 ?
                    (
                        window.location.reload()
                    )
                    :
                    (
                        null
                    )
            }

        </div>
    )

    return (
        <div className="App">
            <br />
            <MaterialTable
                columns={columnas}
                data={listarOrdenes}
                title="GESTIONAR ORDENES DE SERVICIO"
                actions={[
                    {
                        icon: LibraryAddCheckIcon,
                        tooltip: 'Registrar Actividades',
                        onClick: (event, rowData) => seleccionarOrden(rowData, "Editar")
                    },
                    {
                        icon: CreateIcon,
                        tooltip: 'Crear Actividad',
                        onClick: (event, rowData) => seleccionaotCrearActividad(rowData, "CrearActividad")
                    }
                ]}
                options={{
                    actionsColumnIndex: 11,
                    headerStyle: { backgroundColor: '#9e9e9e', fontSize: 12 },
                    rowStyle: {
                        fontSize: 12,
                    }
                }}
                localization={{
                    header: {
                        actions: "Acciones"
                    }
                }}
                detailPanel={[
                    {
                        tooltip: 'Estados del Equipo',
                        render: rowData => {
                            return (
                                <div
                                    style={{
                                        fontSize: 12,
                                        textAlign: 'center',
                                        color: 'white',
                                        backgroundColor: '#0277bd',
                                    }}
                                >
                                    <Button >Email Contacto : {rowData.email_con} </Button> { } Proveedor : {rowData.razonsocial_int}
                                </div>
                            )
                        },
                    },
                ]}
            />
            <Modal title="REGISTRAR ACTIVIDADES OT" visible={modalEditar} onOk={cerrarModalEditar} width={500} closable={false}
                footer={[
                    <Button type="primary" danger onClick={cerrarModalEditar} > Regresar </Button>,
                ]}
            >
                {ordenEditar}
            </Modal>
        </div>
    );
}

export default CumplirOrdenTecnico;
