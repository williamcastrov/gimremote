import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import swal from 'sweetalert';
import { Modal, Button, Form, Input } from "antd";
import LibraryAddCheckIcon from '@material-ui/icons/LibraryAddCheck';

// Componentes de Conexion con el Backend
import crearordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";

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
    const [modalEditar, setModalEditar] = useState(false);
    const [modalOT, setModalOT] = useState(true);
    const [modalPendiente, setModalPendiente] = useState(false);
    const [consumo, setConsumo] = useState(true);
    const [tipoRegistro, setTipoRegistro] = useState(true);
    const [cambio, setCambio] = useState(false);

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

    const leerOrdenes = () => {
        if (tipousuario === 11) {
            async function fetchDataOrdenes() {
                const res = await crearordenesServices.leetodasordentecnico(idUsu);
                setListarOrdenes(res.data);
                //console.log("LEE ORDEN DEL USUARIO : ", res.data);
            }
            fetchDataOrdenes();
        } else {
            async function fetchDataOrdenes() {
                const res = await crearordenesServices.listOrdenesServ();
                setListarOrdenes(res.data);
                //console.log("Lee Ordenes Manual", res.data);
            }
            fetchDataOrdenes();
        }
    }

    const leerOrdenesActivas = () => {
        if (tipousuario === 11) {
            async function fetchDataOrdenes() {
                const res = await crearordenesServices.leeordentecnico(idUsu);
                setListarOrdenes(res.data);
                //console.log("LEE ORDEN DEL USUARIO : ", res.data);
            }
            fetchDataOrdenes();
        } else {
            async function fetchDataOrdenes() {
                const res = await crearordenesServices.listOrdenesServActivas();
                setListarOrdenes(res.data);
                //console.log("Cargar Una Orden", res.data);
            }
            fetchDataOrdenes();
        }
    }

    useEffect(() => {
        if (idUsu > 0) {

            if (tipousuario === 11) {
                async function fetchDataOrdenes() {
                    const res = await crearordenesServices.leeordentecnico(idUsu);
                    setListarOrdenes(res.data);
                    console.log("LEE ORDEN DEL USUARIO : ", res.data);
                }
                fetchDataOrdenes();
            } else {
                async function fetchDataOrdenes() {
                    const res = await crearordenesServices.listOrdenesServActivas();
                    setListarOrdenes(res.data);
                    console.log("Lee Ordenes Automaticas", res.data);
                }
                fetchDataOrdenes();
            }

        }
    }, [idUsu])

    const seleccionarOrden = (orden, caso) => {
        //console.log("DATOS ORDEN : ", orden)
        if (orden.estado_otr === 24 || orden.estado_otr === 27 || orden.estado_otr === 32) {
            swal("Cumplimiento OT", "El estado de la OT no permite cambios", "warning", { button: "Aceptar" });
        } else {
            setOrdenServicio(orden);
            setOrdenSeleccionado(orden);
            setCambio(true);
            //console.log("CLIENTE SELECCIONADO : ", listarClientes);
            (caso === "Editar") ? abrirModalEditar() : abrirCerrarModalPendiente()
        }
    }

    const FirmarOrden = (orden, caso) => {
        //console.log("DATOS ORDEN : ", orden)
        if (orden.estado_otr === 24 || orden.estado_otr === 27 || orden.estado_otr === 32) {
            swal("Cumplimiento OT", "El estado de la OT no permite cambios", "warning", { button: "Aceptar" });
        } else {
            setOrdenServicio(orden);
            setOrdenSeleccionado(orden);
            setCambio(true);
            //console.log("CLIENTE SELECCIONADO : ", listarClientes);
            (caso === "Firmar") ? abrirCerrarModalOT() : abrirCerrarModalPendiente()
        }
    }


    const handleCancel = () => {
        setIsModalVisible(false);
    };

    const abrirCerrarModalInsertar = () => {
        setModalInsertar(!modalInsertar);
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

    const abrirModalOT = () => {
        setModalOT(true);
    }

    const cerrarModalOT = () => {
        setModalOT(false);
    }

    // "string","boolean","numeric","date","datetime","time","currency"
    const columnas = [
        {
            field: 'id_otr',
            title: '# Orden',
            cellStyle: { maxWidth: 50 }
        },
        {
            field: 'fechaprogramada_otr',
            title: 'Fecha de Programación',
            type: 'date',
            cellStyle: { maxWidth: 50 }
        },
        {
            field: 'codigo_equ',
            title: 'Equipo',
            cellStyle: { minWidth: 100 }
        },
        {
            field: 'razonsocial_cli',
            title: 'Cliente',
            cellStyle: { width: 300, maxWidth: 300 }
        },
        {
            field: 'nombre_ciu',
            title: 'Ciudad',
            cellStyle: { minWidth: 150 }
        }
    ]

    const ordenInsertar = (
        console.log("Insertar")
    )

    const ordenEditar = (
        <div className="App">
            <ActividadesOservOperario ordenSeleccionado={ordenSeleccionado} tipoRegistro={tipoRegistro} />
        </div>
    )

    const ordenPendiente = (
        console.log("Pendiente")
    )

    const consultarOT = (
        <div>
            <MaterialTable
                columns={columnas}
                data={listarOrdenes}
                title="GESTIONAR ORDENES DE SERVICIO"
                actions={[
                    {
                        icon: LibraryAddCheckIcon,
                        tooltip: 'Cumplimiento Orden',
                        onClick: (event, rowData) => seleccionarOrden(rowData, "Editar")
                    }
                ]}
                options={{
                    actionsColumnIndex: 11,
                    headerStyle: { backgroundColor: '#9e9e9e', fontSize: 8 },
                    rowStyle: {
                      fontSize: 8,
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
                                        fontSize: 8,
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
        </div>
    )

    return (
        <div className="App">
            <br />
            <Modal title="CONSULTAR OT" visible={modalOT} onOk={cerrarModalOT} width={900} closable={false}
                footer={[
                    <Button type="primary" danger onClick={cerrarModalOT} > Cancelar </Button>,
                ]}
            >
                {consultarOT}
            </Modal>

            <Modal title="CUMPLIMIENTO OT" visible={modalEditar} onOk={cerrarModalEditar} width={1100} closable={false}
                footer={[
                    <Button type="primary" danger onClick={cerrarModalEditar} > Cancelar </Button>,
                ]}
            >
                {ordenEditar}
            </Modal>
        </div>
    );
}

export default CumplirOrdenTecnico;
