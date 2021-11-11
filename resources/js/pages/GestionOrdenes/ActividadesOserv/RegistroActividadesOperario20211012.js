import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import { makeStyles } from "@material-ui/core/styles";
import 'antd/dist/antd.css';
import PropTypes from 'prop-types';
import NumberFormat from 'react-number-format';
import swal from 'sweetalert';
import Moment from 'moment';
import shortid from "shortid";
import './Registro.css';
import { FileAddOutlined, PictureOutlined, CheckSquareOutlined, CloseSquareOutlined, SwitcherOutlined, HighlightOutlined } from '@ant-design/icons';
import ZoomOutMapIcon from '@material-ui/icons/ZoomOutMap';

import MoodBadSharpIcon from '@material-ui/icons/MoodBadSharp';
import SentimentVeryDissatisfiedIcon from '@material-ui/icons/SentimentVeryDissatisfied';
import SentimentDissatisfiedIcon from '@material-ui/icons/SentimentDissatisfied';
import SentimentSatisfiedIcon from '@material-ui/icons/SentimentSatisfied';
import SentimentVerySatisfiedIcon from '@material-ui/icons/SentimentVerySatisfied';

// Floating Button
import { Container, Button as Bottom, Link, lightColors, darkColors } from 'react-floating-action-button';

import Images from "../../Images";
import FirmarOT from "../../GestionOrdenes/FirmarOT/FirmarOT";
import NombreCargoOT from "../../GestionOrdenes/NombreCargoOT";

// Componentes de Conexion con el Backend
import cumplimientooservServices from "../../../services/GestionOrdenes/CumplimientoOserv";
import calificacionserviciootServices from "../../../services/GestionOrdenes/CalificacionServicioOT";
import tipooperacionServices from "../../../services/GestionOrdenes/TipoOperacion";
import actividadrealizadaServices from "../../../services/GestionOrdenes/ActividadRealizada";
import crearordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";
import tiposFallasServices from "../../../services/Mantenimiento/TiposFallas";
import fallasMttoServices from "../../../services/Mantenimiento/FallasMtto";
import datoshorometroServices from "../../../services/Mantenimiento/DatosHorometro";
import estadosServices from "../../../services/Parameters/Estados";

const useStyles = makeStyles((theme) => ({
  modal: {
    position: 'absolute',
    width: 600,
    backgroundColor: theme.palette.background.paper,
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)'
  },
  iconos: {
    cursor: 'pointer'
  },
  inputMaterial: {
    width: '100%'
  },
  formControl: {
    margin: theme.spacing(0),
    minWidth: 250,
  },
  floatingbutton: {
    margin: 55,
    top: 'auto',
    right: 160,
    bottom: 160,
    left: 160,
    position: 'fixed',
  }
}));

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

function NumberFormatCustom(props) {
  const { inputRef, onChange, ...other } = props;

  return (
    <NumberFormat
      {...other}
      getInputRef={inputRef}
      onValueChange={(values) => {
        onChange({
          target: {
            name: props.name,
            value: values.value,
          },
        });
      }}
      thousandSeparator
      isNumericString
      prefix="$"
    />
  );
}

NumberFormatCustom.propTypes = {
  inputRef: PropTypes.func.isRequired,
  name: PropTypes.string.isRequired,
  onChange: PropTypes.func.isRequired,
};

function RegistroActividadesOperario(props) {
  const { id_otr, nombre_emp, razonsocial_cli, telefono_cli, nombre_ciu, email_cli, descripcion_mar, modelo_dequ,
    fechainicia_otr, descripcion_tser, descripcion_tmt, serie_dequ, codigo_equ, descripcion_con, primer_apellido_con,
    primer_nombre_con, horometro_otr, iniciatransporte_otr, finaltransporte_otr, tiempotransporte_otr,
    tiempoorden_otr, estado_otr
  } = props.ordenSeleccionado;

  const styles = useStyles();

  const { operario } = props;
  const { tipoRegistro } = props;
  /*
  console.log("EMAIL : ", email_cli)
  console.log("# ORDEN : ", id_otr)
  console.log("FECHA INICIA : ", finaltransporte_otr)
  console.log("TIEMPO DE TRANSPORTE : ", tiempotransporte_otr)
*/
  const [listUnaOrden, setListUnaOrden] = useState([]);
  const [listUnCumplimiento, setListUnCumplimiento] = useState([]);

  const [modalEditar, setModalEditar] = useState(false);
  const [modalRevisarCumplimiento, setModalRevisarCumplimiento] = useState(false);
  const [modalActualizarCumplimiento, setModalActualizarCumplimiento] = useState(false);
  const [modalCerrarOrden, setModalCerrarOrden] = useState(false);
  const [modalFotos, setModalFotos] = useState(false);
  const [modalCalificarServicio, setModalCalificarServicio] = useState(false);
  const [modalEliminarActividad, setModalEliminarActividad] = useState(false);
  const [modalGrabarHorometro, setModalGrabarHorometro] = useState(false);
  const [modalNombreCargo, setModalNombreCargo] = useState(false);
  const [modalFirmarOT, setModalFirmarOT] = useState(false);

  const [formError, setFormError] = useState(false);
  const [listarTipoOperacion, setListarTipoOperacion] = useState([]);
  const [listarActividadRealizada, setListarActividadRealizada] = useState([]);
  const [listarFallasMtto, setListarFallasMtto] = useState([]);
  const [listarTiposFallas, setListarTiposFallas] = useState([]);
  const [listarEstados, setListarEstados] = useState([]);
  const [grabar, setGrabar] = React.useState(false);
  const [grabarCambios, setGrabarCambios] = React.useState(false);
  const [grabarCalificacionOT, setGrabarCalificacionOT] = React.useState(false);
  const [controlHorometro, setControlHorometro] = React.useState(false);
  const fechaactual = Moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
  const horaactual = Moment(new Date()).format('HH:mm:ss');
  const [activo, setActivo] = useState(false);
  const [actualiza, setActualiza] = useState(false);

  const [idCumplimiento, setIdCumplimiento] = useState(0);
  const [tipooperacion, setTipoOperacion] = useState(0);
  const [referencia, setReferencia] = useState(0);
  const [fallamtto, setFallaMtto] = useState(0);
  const [actividadrealizada, setActividadrealizada] = useState(0);
  const [fechainicial, setFechainicial] = useState(fechaactual);
  const [fechafinal, setFechafinal] = useState(fechaactual);
  const [tiempoActividad, setTiempoActividad] = useState(0);
  const [horainicial, setHorainicial] = useState(horaactual);
  const [horafinal, setHorafinal] = useState(horaactual);
  const [cantidad, setCantidad] = useState(0);
  const [valorunitario, setValorunitario] = useState(0);
  const [valortotal, setValortotal] = useState(0);
  const [serviciorealizado, setServicioRealizado] = useState(1);
  const [estadoOperacionEquipos, setEstadoOperacionEquipos] = useState(0);
  const [observacion, setObservacion] = useState(0);
  const [datoHorometro, setDatoHorometro] = useState(0);
  const [horometro, setHorometro] = useState(horometro_otr);
  const [tiempoTransporte, setTiempoTransporte] = useState(tiempotransporte_otr);
  const [fechaIniciaTransporte, setFechaIniciaTransporte] = useState(iniciatransporte_otr);
  const [fechaFinalTransporte, setFechaFinalTransporte] = useState(finaltransporte_otr);
  const [inventariosSeleccionado, setInventariosSeleccionado] = useState([]);
  const [orden, setOrden] = useState([]);

  let servicio = 1;

  const [cumplimientoSeleccionado, setCumplimientoSeleccionado] = useState({
    id: "",
    id_cosv: "",
    descripcion_cosv: "",
    tipooperacion_cosv: "",
    tipofallamtto_cosv: "",
    referencia_cosv: "",
    fechainicia_cosv: finaltransporte_otr,
    fechafinal_cosv: "",
    cantidad_cosv: "",
    valorunitario_cosv: "",
    valortotal_cosv: "",
    servicio_cosv: servicio,
    observacion_cosv: "",
    tiempoactividad_cosv: 0,
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

  const [horometroSeleccionado, setHorometroSeleccionado] = useState({
    id_dhr: "",
    codigoequipo_dhr: "",
    valorhorometro_dhr: ""
  });

  const [calificacionServicioOTSeleccionado, setCalificacionServicioOTSeleccionado] = useState({
    ot_cse: "",
    valorservicio_cse: 0
  })


  useEffect(() => {
    async function fetchDataFallasMtto() {
      const res = await fallasMttoServices.listfallasmtto();
      setListarFallasMtto(res.data);
    }
    fetchDataFallasMtto();
  }, [])

  useEffect(() => {
    async function fetchDataTiposFallasMtto() {
      const res = await tiposFallasServices.listTiposFallas();
      setListarTiposFallas(res.data);
      console.log("TIPO DE FALLA : ", res.data)
    }
    fetchDataTiposFallasMtto();
  }, [])

  useEffect(() => {
    async function fetchDataTipoOperacion() {
      const res = await tipooperacionServices.listTipooperacion();
      setListarTipoOperacion(res.data);
      console.log("TIPO OPERACION : ", res.data)
    }
    fetchDataTipoOperacion();
  }, [])

  useEffect(() => {
    async function fetchDataActividadRealizada() {
      const res = await actividadrealizadaServices.listActividadrealizada();
      setListarActividadRealizada(res.data);
      //console.log("ACTIVIDAD REALIZADA : ", res.data)
    }
    fetchDataActividadRealizada();
  }, [])

  useEffect(() => {
    async function fetchDataEstados() {
      const res = await estadosServices.listEstadosEquiposOperacion();
      setListarEstados(res.data);
      //console.log("ESATDOS : ", res.data)
    }
    fetchDataEstados();
  }, [])

  useEffect(() => {
    async function fetchDataUnCumplimiento() {
      const res = await cumplimientooservServices.listUnCumplimiento(id_otr);
      setListUnCumplimiento(res.data);
      setActualiza(false);
      if (res.data) {
        setActivo(true)
      } else { setActivo(false) }
    }
    fetchDataUnCumplimiento();
  }, [actualiza])

  const actualizarValoresOrden = () => {
    async function fetchDataOrdenes() {
      const res = await crearordenesServices.listUnaOrden(id_otr);
      setListUnaOrden(res.data);
    }
    fetchDataOrdenes();
  }

  const handleChange = e => {
    const { name, value } = e.target;

    setCumplimientoSeleccionado(prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  const seleccionarCumplimiento = (cumplimiento, caso) => {
    console.log("DATOS CUMPLIMIENTO : ", cumplimiento)
    setCumplimientoSeleccionado(cumplimiento);
    (caso === "Editar") ? abrirModalActualizarCumplimiento() : abrirCerrarModalEliminarActividad()
  }

  const abrirModalEditar = () => {
    setModalEditar(true);
  }

  const cerrarModalEditar = () => {
    setModalEditar(false);
  }

  const abrirModalRevisarCumplimiento = () => {
    setModalRevisarCumplimiento(true);
  }

  const cerrarModalRevisarCumplimiento = () => {
    setModalRevisarCumplimiento(false);
  }

  const abrirModalActualizarCumplimiento = () => {
    setModalActualizarCumplimiento(true);
  }

  const cerrarModalActualizarCumplimiento = () => {
    setModalActualizarCumplimiento(false);
  }

  const abrirModalCerrarOrden = () => {
    setModalCerrarOrden(true);
  }

  const cerrarModalCerrarOrden = () => {
    setModalCerrarOrden(false);
  }

  const abrirModalFoto = () => {
    setModalFotos(true);
  }

  const cerrarModalFoto = () => {
    setModalFotos(false);
  }

  const abrirModalCalificarServicio = () => {
    setModalCalificarServicio(true);
  }

  const cerrarModalCalificarServicio = () => {
    setModalCalificarServicio(false);
  }

  const abrirModalFirmarOT = () => {
    setModalFirmarOT(true);
  }

  const cerrarModalFirmarOT = () => {
    setModalFirmarOT(false);
  }

  const abrirModalNombreCargo = () => {
    setModalNombreCargo(true);
  }

  const cerrarModalNombreCargo = () => {
    setModalNombreCargo(false);
  }

  const abrirCerrarModalEliminarActividad = () => {
    setModalEliminarActividad(!modalEliminarActividad);
  }

  const consultarCumplimiento = () => {
    async function fetchDataUnCumplimiento() {
      const res = await cumplimientooservServices.listUnCumplimiento(id_otr);
      setListUnCumplimiento(res.data);
      if (res.data) {
        setActivo(true)
      } else { setActivo(false) }

      if (!res.data) {
        swal("Orden de Trabajo", "OT sin registros, Debe Diligenciar OT", "warning", { button: "Aceptar" });
        return
      } else {
        abrirModalRevisarCumplimiento();
      }
    }
    fetchDataUnCumplimiento();
  }

  const pasarARevision = async () => {
    console.log("DATOS DE LA ORDEN : ", listUnaOrden[0])
    
    console.log("VALOR ACTUALIZADO ORDEN", listUnaOrden[0].horometro_otr);

    if (!listUnaOrden[0].horometro_otr) {
      swal("Horometro", "El valor del Horometro no puede ser CERO", "warning", { button: "Aceptar" });
      return
    }

    if (listUnaOrden[0].horometro_otr === 0) {
      swal("Horometro", "El valor del Horometro no puede ser CERO", "warning", { button: "Aceptar" });
      return
    } else {
      const res = await crearordenesServices.pasararevision(id_otr);

      if (res.success) {
        swal("Orden de Servicio", "Estado de la Orden paso a Revisión!", "success", { button: "Aceptar" });

        const res = await crearordenesServices.sumartiempoactividades(id_otr);

        if (res.success) {
          swal("Orden de Servicio", "Tiempo de Actividades de la Orden Actualizados!", "success", { button: "Aceptar" });
        }
        else
          swal("Orden de Servicio", "Error Actualizando tiempo de actividad de la Orden!", "error", { button: "Aceptar" });
      }
      else
        swal("Orden de Servicio", "Error Estado de la Orden no puede ser Actualizada!", "error", { button: "Aceptar" });

      console.log(res.message)
    }
  }

  const cerrarOrden = async () => {
    if (estado_otr === 24 || estado_otr === 27) {
      swal("Estado Orden", "El estado de la orden no permite CERRAR", "warning", { button: "Aceptar" });
    } else {
      if (horometro_otr === 0) {
        swal("Horometro", "El valor del Horometro no puede ser CERO", "warning", { button: "Aceptar" });
      } else {
        const res = await crearordenesServices.cerrarot(id_otr);

        if (res.success)
          swal("Orden de Servicio", "Orden de Trabajo Cerrada!", "success", { button: "Aceptar" });
        else
          swal("Orden de Servicio", "Error Cerrando la Orden de Trabajo!", "success", { button: "Aceptar" });

        setActualiza(true);
        console.log(res.message)
      }
    }
  }

  const FirmarOrden = () => {
    //console.log("DATOS ORDEN : ", orden)
    if (estado_otr === 24 || estado_otr === 27 || estado_otr === 32) {
      swal("Cumplimiento OT", "El estado de la OT no permite cambios", "warning", { button: "Aceptar" });
    } else {
      //setOrdenServicio(orden);
      //setOrdenSeleccionado(orden);
      //setCambio(true);
      //console.log("CLIENTE SELECCIONADO : ", listarClientes);
      abrirModalFirmarOT()
    }
  }

  const abrirModalGrabarHorometro = () => {
    setModalGrabarHorometro(true);
  }

  const cerrarModalGrabarHorometro = () => {
    setModalGrabarHorometro(false);
  }

  const grabarValorHorometro = async () => {
    const res = await datoshorometroServices.listUnDatoHorometro(props.ordenSeleccionado.equipo_otr);

    console.log("DATOS HOROMETERO : ", res.data)

    if (!res.data) {
      {
        setHorometroSeleccionado([{
          id_dhr: 0,
          codigoequipo_dhr: props.ordenSeleccionado.equipo_otr,
          valorhorometro_dhr: horometro
        }]);
      }
      setDatoHorometro(1);
    } else {
      if (horometro <= res.data[0].valorhorometro_dhr) {
        swal("Control Horometro", "Valor Ingresado al Horometero no puede ser Menor al Anterior!", "error", { button: "Aceptar" });
        console.log("VALOR HOROMETRO GUARDADO : ", res.data[0].valorhorometro_dhr);
        return
      }
      setDatoHorometro(2);
    }

    if (res.data) {
      setHorometroSeleccionado([{
        id_dhr: res.data[0].id_dhr,
        codigoequipo_dhr: props.ordenSeleccionado.equipo_otr,
        valorhorometro_dhr: horometro
      }]);
    }

  

    const a = Date.parse(fechaFinalTransporte);
    const b = Date.parse(fechaIniciaTransporte);
    setTiempoTransporte(Math.trunc(((a - b) * 0.0166667) / 1000));

    //console.log("VALOR DE A: ", fechaFinalTransporte, a)
    //console.log("VALOR DE B: ", fechaIniciaTransporte, b)

    let tiempo = (Math.trunc(((a - b) * 0.0166667) / 1000))

    let validatiempo = a - b;
    console.log("FECHA FINAL : ", a)
    console.log("FECHA INICIAL : ", b)
    console.log("VALIDA TIEMPO : ", validatiempo);

    if(validatiempo === 0){
      swal("TIEMPO DE TRANSPORTE", "Tiempo de Transporte no puede ser CERO, REVISAR!", "warning", { button: "Aceptar" });
      return
    }

    //console.log("VALOR HOROMETRO : ", horometro);

    setOrden([{
      id_otr: props.ordenSeleccionado.id_otr,
      estado_otr: props.ordenSeleccionado.estado_otr,
      tipo_otr: props.ordenSeleccionado.tipo_otr,
      tipooperacion_otr: props.ordenSeleccionado.tipooperacion_otr,
      tiposervicio_otr: props.ordenSeleccionado.tiposervicio_otr,
      fechaprogramada_otr: props.ordenSeleccionado.fechaprogramada_otr,
      fechainicia_otr: props.ordenSeleccionado.fechainicia_otr,
      fechafinal_otr: props.ordenSeleccionado.fechafinal_otr,
      diasoperacion_otr: 0,
      equipo_otr: props.ordenSeleccionado.equipo_otr,
      proveedor_otr: props.ordenSeleccionado.proveedor_otr,
      cliente_otr: props.ordenSeleccionado.cliente_otr,
      operario_otr: props.ordenSeleccionado.operario_otr,
      contactocliente_otr: props.ordenSeleccionado.contactocliente_otr,
      subgrupoequipo_otr: props.ordenSeleccionado.subgrupoequipo_otr,
      ciudad_otr: props.ordenSeleccionado.ciudad_otr,
      resumenorden_otr: props.ordenSeleccionado.resumenorden_otr,
      prioridad_otr: props.ordenSeleccionado.prioridad_otr,
      empresa_otr: props.ordenSeleccionado.empresa_otr,
      horometro_otr: horometro,
      iniciatransporte_otr: fechaIniciaTransporte,
      finaltransporte_otr: fechaFinalTransporte,
      tiempotransporte_otr: tiempo,
      tiempoorden_otr: 0
    }]);
    setControlHorometro(true);
  }

  useEffect(() => {
    async function grabarValorHorometro() {

      if (controlHorometro) {
        console.log("VALOR DEL HOROMETRO : ", orden[0])
        console.log("ACTUALIZA O GRABA : ", datoHorometro)

        const res = await crearordenesServices.update(orden[0]);

        if (res.success) {
          swal("Horometro", "Valor del Horometro Actualizado!", "success", { button: "Aceptar" });
          console.log(res.message)

          if (datoHorometro === 1) {
            const rest = await datoshorometroServices.save(horometroSeleccionado[0]);
            if (rest.success) {
              swal("Control Horometro", "Control del Horometro Grabado!", "success", { button: "Aceptar" });
              console.log(res.message)
            } else {
              swal("Control Horometro", "Error Grabando Control del Horometro!", "error", { button: "Aceptar" });
              console.log(res.message);
            }
          } else {
            if (datoHorometro === 2) {
              const rest = await datoshorometroServices.update(horometroSeleccionado[0]);
              if (rest.success) {
                swal("Control Horometro", "Control del Horometro Actualizado!", "success", { button: "Aceptar" });
                console.log(res.message)
              } else {
                swal("Control Horometro", "Error Actualizando Control del Horometro!", "error", { button: "Aceptar" });
                console.log(res.message);
              }
            }
          }
        } else {
          swal("Horometro", "Error Actualizando Valor del Horometro!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setControlHorometro(false);
        setActualiza(true);
        cerrarModalGrabarHorometro();
      }
    }
    grabarValorHorometro();
    actualizarValoresOrden();
  }, [controlHorometro])


  const iniciarCumplimiento = async () => {
    console.log("FECHA : ", finaltransporte_otr)
    /*
    if (finaltransporte_otr != "2000-01-01 12:00:00") {
      swal("OT", "Esta OT tiene un registro de Inicio de Actividad, Revisar!", "warning", { button: "Aceptar" });
      return
    }
*/
    const res = await crearordenesServices.actualizafinaltransporte(id_otr);

    if (res.success) {
      swal("Transporte", "Fecha Final Transporte!", "success", { button: "Aceptar" });
      console.log(res.message)
      actualizarValoresOrden();
    } else {
      swal("Transporte", "Error Actualizando Fecha Final Transporte!", "error", { button: "Aceptar" });
      console.log(res.message);
    }

  }

  const iniciarTransporte = async () => {
    console.log("FECHA : ", iniciatransporte_otr)
    /*
    if (iniciatransporte_otr != "2000-01-01 12:00:00") {
      swal("OT", "Esta OT tiene un registro de Inicio de Transporte, Revisar!", "warning", { button: "Aceptar" });
      return
    }
*/
    const res = await crearordenesServices.actualizainiciatransporte(id_otr);

    if (res.success) {
      swal("Transporte", "Actualizada Fecha Inicial Transporte!", "success", { button: "Aceptar" });
      console.log(res.message)
      actualizarValoresOrden();
    } else {
      swal("Transporte", "Error Actualizando Fecha Inicial Transporte!", "error", { button: "Aceptar" });
      console.log(res.message);
    }
  }

  const grabarCumplimiento = async () => {

    const a = Date.parse(fechafinal);
    const b = Date.parse(finaltransporte_otr);
    setTiempoActividad(Math.trunc(((a - b) * 0.0166667) / 1000));

    let tiempo = (Math.trunc(((a - b) * 0.0166667) / 1000))

    setFormError({});
    let errors = {};
    let formOk = true;

    {
      let resultado = (cantidad * valorunitario)
      //Asignar Valores al Estado Cumplimiento
      setCumplimientoSeleccionado([{
        id: idCumplimiento,
        id_cosv: props.ordenSeleccionado.id_otr,
        descripcion_cosv: actividadrealizada,
        tipooperacion_cosv: tipooperacion,
        tipofallamtto_cosv: fallamtto,
        referencia_cosv: referencia,
        fechainicia_cosv: finaltransporte_otr,
        fechafinal_cosv: fechaactual,
        cantidad_cosv: cantidad,
        valorunitario_cosv: valorunitario,
        valortotal_cosv: resultado,
        servicio_cosv: serviciorealizado,
        observacion_cosv: observacion,
        tiempoactividad_cosv: tiempo,
        estadooperacionequipo_cosv: 81
      }]);
    }
    setGrabar(true);
    cerrarModalEditar();
  }

  const grabarObservacion = async () => {

    setFormError({});
    let errors = {};
    let formOk = true;

    {
      let resultado = (cantidad * valorunitario)
      //Asignar Valores al Estado Cumplimiento
      setCumplimientoSeleccionado([{
        id: shortid(),
        id_cosv: props.ordenSeleccionado.id_otr,
        descripcion_cosv: "",
        tipooperacion_cosv: tipooperacion,
        tipofallamtto_cosv: 48,
        referencia_cosv: "Observación",
        fechainicia_cosv: finaltransporte_otr,
        fechafinal_cosv: fechaactual,
        cantidad_cosv: 0,
        valorunitario_cosv: 0,
        valortotal_cosv: 0,
        servicio_cosv: 1,
        observacion_cosv: "",
        tiempoactividad_cosv: 0,
        estadooperacionequipo_cosv: 81
      }]);
    }
    setGrabar(true);
  }

  const guardarCambiosCumplimiento = async () => {

    const a = Date.parse(cumplimientoSeleccionado.fechafinal_cosv);
    const b = Date.parse(cumplimientoSeleccionado.fechainicia_cosv);
    setTiempoActividad(Math.trunc(((a - b) * 0.0166667) / 1000));

    let tiempo = (Math.trunc(((a - b) * 0.0166667) / 1000))

    {
      let resultado = (cumplimientoSeleccionado.cantidad_cosv * cumplimientoSeleccionado.valorunitario_cosv)
      //Asignar Valores al Estado Cumplimiento
      setCumplimientoSeleccionado([{
        id: cumplimientoSeleccionado.id,
        id_cosv: props.ordenSeleccionado.id_otr,
        descripcion_cosv: cumplimientoSeleccionado.descripcion_cosv,
        tipooperacion_cosv: cumplimientoSeleccionado.tipooperacion_cosv,
        tipofallamtto_cosv: cumplimientoSeleccionado.tipofallamtto_cosv,
        referencia_cosv: cumplimientoSeleccionado.referencia_cosv,
        fechainicia_cosv: finaltransporte_otr,
        fechafinal_cosv: cumplimientoSeleccionado.fechafinal_cosv,
        cantidad_cosv: cumplimientoSeleccionado.cantidad_cosv,
        valorunitario_cosv: cumplimientoSeleccionado.valorunitario_cosv,
        valortotal_cosv: resultado,
        servicio_cosv: cumplimientoSeleccionado.servicio_cosv,
        observacion_cosv: cumplimientoSeleccionado.observacion_cosv,
        tiempoactividad_cosv: tiempo,
        estadooperacionequipo_cosv: cumplimientoSeleccionado.estadooperacionequipo_cosv
      }]);
    }
    setGrabarCambios(true);
  }

  const borraActividadOrden = async () => {

    const res = await cumplimientooservServices.delete(cumplimientoSeleccionado.id);

    if (res.success) {
      swal("Actividad de la Orden", "Borrada de forma Correcta!", "success", { button: "Aceptar" });
      console.log(res.message)
      abrirCerrarModalEliminarActividad();

      delete cumplimientoSeleccionado.descripcion_cosv;
      delete cumplimientoSeleccionado.tipooperacion_cosv;
      delete cumplimientoSeleccionado.referencia_cosv;
      delete cumplimientoSeleccionado.tipofallamtto_cosv;
      delete cumplimientoSeleccionado.fechainicia_cosv;
      delete cumplimientoSeleccionado.fechafinal_cosv;
      delete cumplimientoSeleccionado.cantidad_cosv;
      delete cumplimientoSeleccionado.valorunitario_cosv;
      delete cumplimientoSeleccionado.valortotal_cosv;
      delete cumplimientoSeleccionado.servicio_cosv;
      delete cumplimientoSeleccionado.observacion_cosv;
    }
    else {
      swal("Actividad de la Orden", "Error Borrando Actividad de la Orden!", "error", { button: "Aceptar" });
      console.log(res.message);
      abrirCerrarModalEliminarActividad();
    }
    setActualiza(true);
  }

  useEffect(() => {
    async function guardarCambiosCumplimiento() {
      if (grabarCambios) {
        //console.log("VALORES A GUARDAR : ",cumplimientoSeleccionado[0])

        const res = await cumplimientooservServices.update(cumplimientoSeleccionado[0]);

        if (res.success) {
          swal("Orden de Servicio", "Orden de Servicio Actualizada de forma Correcta!", "success", { button: "Aceptar" });
          console.log(res.message)
          delete cumplimientoSeleccionado.descripcion_cosv;
          delete cumplimientoSeleccionado.tipooperacion_cosv;
          delete cumplimientoSeleccionado.referencia_cosv;
          delete cumplimientoSeleccionado.tipofallamtto_cosv;
          delete cumplimientoSeleccionado.fechainicia_cosv;
          delete cumplimientoSeleccionado.fechafinal_cosv;
          delete cumplimientoSeleccionado.cantidad_cosv;
          delete cumplimientoSeleccionado.valorunitario_cosv;
          delete cumplimientoSeleccionado.valortotal_cosv;
          delete cumplimientoSeleccionado.servicio_cosv;
          delete cumplimientoSeleccionado.observacion_cosv;
          abrirCerrarModalActualizarCumplimiento();
        } else {
          swal("Orden de Servicio", "Error Actualizando la Orden de Servicio!", "error", { button: "Aceptar" });
          console.log(res.message);
          abrirCerrarModalActualizarCumplimiento();
        }
        setGrabarCambios(false);
        setActualiza(true);
        //abrirCerrarModalCumplimiento();
        abrirCerrarModalActualizarCumplimiento();
      }
    }
    guardarCambiosCumplimiento();
  }, [grabarCambios])

  function handleChanged(value) {
    console.log(`selected ${value}`);
  }

  function seleccionarFallaMtto(value) {
    //console.log("FALLA DE MANTENIMIENTO", value);

    async function fetchDataFallasMtto() {
      const res = await fallasMttoServices.leerFallaTipo(value);
      setListarFallasMtto(res.data);
      //console.log("FALLAS POR TIPO : ", res.data);
    }

    fetchDataFallasMtto();
  }

  function seleccionarEstadoOperacionEquipos(value) {
    console.log("ESTADO OPERACION EQUIPO", value);
    setEstadoOperacionEquipos(value);
  }

  useEffect(() => {
    async function grabarCumplimiento() {

      if (grabar) {
        console.log("DATOS CUMPLIMIENTO : ", cumplimientoSeleccionado[0])

        const res = await cumplimientooservServices.save(cumplimientoSeleccionado[0]);

        if (res.success) {

          swal("Actividades Orden de Servicio", "Creada de forma Correcta!", "success", { button: "Aceptar" });
          delete cumplimientoSeleccionado.descripcion_cosv;
          delete cumplimientoSeleccionado.tipooperacion_cosv;
          delete cumplimientoSeleccionado.referencia_cosv;
          delete cumplimientoSeleccionado.tipofallamtto_cosv;
          delete cumplimientoSeleccionado.fechainicia_cosv;
          delete cumplimientoSeleccionado.fechafinal_cosv;
          delete cumplimientoSeleccionado.cantidad_cosv;
          delete cumplimientoSeleccionado.valorunitario_cosv;
          delete cumplimientoSeleccionado.valortotal_cosv;
          delete cumplimientoSeleccionado.servicio_cosv;
          delete cumplimientoSeleccionado.observacion_cosv;
          console.log(res.message)
        } else {
          swal("Actividades Orden de Servicio", "Error registrando la Actividad!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabar(false);
        setActualiza(true);
        //abrirCerrarModalCumplimiento();
      }
    }
    grabarCumplimiento();
  }, [grabar])

  const openModalFotos = () => {
    abrirModalFoto()
  }

  const calificarServicio = () => {
    abrirModalCalificarServicio()
  }

  const agregarCumplimientoOperacion = () => {
    console.log("FECHA HORA FINAL TRANSPORTE : ", finaltransporte_otr)
    // the item selected
    {
      setIdCumplimiento(shortid());
      setTipoOperacion(8);
      setReferencia("OperacionMantenimiento");
      setFallaMtto(48),
        setActividadrealizada("");
      setFechainicial(finaltransporte_otr);
      setFechafinal(fechaactual);
      setHorainicial(horaactual);
      setHorafinal(horaactual);
      setCantidad(0);
      setValorunitario(0);
      setValortotal(0);

      //item.map((asignar) => (
      setCumplimientoSeleccionado([{
        id: idCumplimiento,
        id_cosv: id_otr,
        descripcion_cosv: "",
        tipooperacion_cosv: 8,
        tipofallamtto_cosv: 48,
        referencia_cosv: "OperacionMantenimiento",
        fechainicia_cosv: finaltransporte_otr,
        fechafinal_cosv: fechaactual,
        cantidad_cosv: 0,
        valorunitario_cosv: 0,
        valortotal_cosv: 0,
        servicio_cosv: servicio,
        observacion_cosv: "",
        tiempoactividad_cosv: 0,
        estadooperacionequipo_cosv: cumplimientoSeleccionado.estadooperacionequipo_cosv
      }]);
    }
    abrirModalEditar();
  };

  const grabarCalificacionServicio = (valor) => {

    swal({
      title: "Confirmar Calificación?",
      text: "Registrar esta Calificacion!",
      icon: "warning",
      buttons: true,
      dangerMode: false,
    })
      .then((willDelete) => {
        if (willDelete) {
          {
            setCalificacionServicioOTSeleccionado([{
              ot_cse: id_otr,
              valorservicio_cse: valor
            }]);
          }
          setGrabarCalificacionOT(true);
        } else {
          return
        }
      });
  }

  useEffect(() => {
    async function grabarCalificacion() {

      if (grabarCalificacionOT) {
        console.log("DATOS CALIFICACION SERVICIO : ", calificacionServicioOTSeleccionado[0])

        const res = await calificacionserviciootServices.save(calificacionServicioOTSeleccionado[0]);

        if (res.success) {
          swal("Calificación Servicio", "Grabado de forma Correcta!", "success", { button: "Aceptar" });
          console.log(res.message)
        } else {
          swal("Calificación Servicio", "Error Grabando Calificación!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabarCalificacion(false);
        setActualiza(true);
        //abrirCerrarModalCumplimiento();
      }
    }
    grabarCalificacion();
  }, [grabarCalificacionOT])

  const cumplimiento = [
    {
      title: '# OT',
      field: 'id_cosv',
      cellStyle: { minWidth: 50 }
    },
    {
      title: 'Actividad',
      field: 'descripcion_cosv',
      cellStyle: { minWidth: 250 }
    },
    {
      title: 'Referencia',
      field: 'referencia_cosv',
      cellStyle: { minWidth: 100 }
    },
    {
      title: 'Fecha Inicia',
      field: 'fechainicia_cosv',
      type: "date",
      cellStyle: { minWidth: 100 }
    },
    {
      title: 'Fecha Fin',
      field: 'fechafinal_cosv',
      type: "date",
      cellStyle: { minWidth: 100 }
    },
    {
      title: 'Observación',
      field: 'observacion_cosv',
      cellStyle: { minWidth: 300 }
    }
  ]

  const layout = {
    labelCol: {
      span: 8
    },
    wrapperCol: {
      span: 16
    }
  }

  const CumplimientoOrden = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Registrar Actividad a la Orden de Servicio
      </Title>
      <Form {...layout} >
        <Row justify="center" >
          <Col span={8}>
            <Item
              label="Id Cumplimiento"
            >
              <Input
                style={{ width: 220 }}
                name='id'
                defaultValue={idCumplimiento}
                disabled="true"
                onChange={handleChange}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.id}
              ></Input>
            </Item>
          </Col>
          <Col span={6}>
            <Item
              label="OT #"
            >
              <Input
                style={{ width: 220 }}
                name='id_cosv'
                disabled="true"
                defaultValue={id_otr}
                onChange={handleChange}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.id_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Tipo Mtto"
            >
              <Select
                style={{ width: 220 }}
                disabled="true"
                name="tipooperacion_cosv"
                defaultValue={tipooperacion}
                placeholder="Seleccione Tipo de Operación"
                onChange={handleChanged}
              >
                {
                  listarTipoOperacion && listarTipoOperacion.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_tope}>{itemselect.descripcion_tope}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>

        <Row justify="center"  >
          <Col span={8}>
            <Item
              label="Referencia"
            >
              <Input
                name='referencia_cosv'
                defaultValue={referencia}
                disabled="true"
                onChange={(e) => setReferencia(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.referencia_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={6}>
            <Item
              label="Falla Mtto"
            >
              <Select
                style={{ width: 220 }}
                name="tipooperacion_cosv"
                placeholder="Seleccione Falla de Mtto"
                onChange={seleccionarFallaMtto}
              >
                {
                  listarTiposFallas && listarTiposFallas.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_tfa}>{itemselect.descripcion_tfa}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Tipo"
            >
              <Select
                style={{ width: 220 }}
                name="tipofallamtto_cosv"
                placeholder="Seleccione Tipo de Falla de Mtto"
                onChange={handleChanged}
              >
                {
                  listarFallasMtto && listarFallasMtto.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_fmt}>{itemselect.descripcion_fmt}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
        <Row justify="lef">
          <Col span={14}>
            <Item
              label="Actividad Realizada"
            >
              <Input
                name='descripcion_cosv'
                style={{ width: 800 }}
                onChange={(e) => setActividadrealizada(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.descripcion_cosv}
              ></Input>
            </Item>
          </Col>
        </Row>
        <Row justify="center">
          <Col span={8}>
            <Item
              label="Fecha Inicia"
            >
              <Input
                name='fechainicia_cosv'
                type="datetime-local"
                value={finaltransporte_otr}
                disabled="true"
                onChange={(e) => setFechainicial(e.target.value)}
                InputLabelProps={{ shrink: true }}
                defaultValue={Moment(inventariosSeleccionado.fechaactual).format('YYYY-MM-DD HH:mm:ss')}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.fechainicia_cosv}
              >
              </Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Fecha Finaliza"
            >
              <Input
                name='fechafinal_cosv'
                type="datetime-local"
                value={fechafinal}
                disabled="true"
                onChange={(e) => setFechafinal(e.target.value)}
                InputLabelProps={{ shrink: true }}
                defaultValue={Moment(inventariosSeleccionado.fechaactual).format('YYYY-MM-DD HH:mm:ss')}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.fechafinal_cosv}
              >
              </Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Servicio :"
            >
              <Select
                style={{ width: 220 }}
                name="servicio_cosv"
                defaultValue={servicio}
                placeholder="Seleccione Servicio Realizado"
                onChange={handleChanged}
              //onChange={(e) => setServicioRealizado(e.target.value)}
              >
                {
                  listarActividadRealizada && listarActividadRealizada.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_are}>{itemselect.descripcion_are}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
        <Row justify="left">
          <Col span={16}>
            <Item
              label="Observaciones"
            >
              <Input
                name="observacion_cosv"
                value={observacion}
                onChange={(e) => setObservacion(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.observacion_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Estado del Equipo"
            >
              <Select
                style={{ width: 220 }}
                name="estadooperacionequipo_cosv"
                placeholder="Estado del Equipo"
                onChange={seleccionarEstadoOperacionEquipos}
              //onChange={(e) => setServicioRealizado(e.target.value)}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_est}>{itemselect.nombre_est}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
      </Form>
    </div >
  )

  const actualizarCumplimiento = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Actualizar Actividades Cumplimiento
      </Title>
      <Form {...layout} >
        <Row justify="center" >
          <Col span={8}>
            <Item
              label="Id Cumplimiento"
            >
              <Input
                style={{ width: 220 }}
                name='id'
                defaultValue={idCumplimiento}
                disabled="true"
                onChange={handleChange}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.id}
              ></Input>
            </Item>
          </Col>
          <Col span={6}>
            <Item
              label="OT #"
            >
              <Input
                style={{ width: 220 }}
                name='id_cosv'
                disabled="true"
                defaultValue={id_otr}
                onChange={handleChange}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.id_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Tipo Mtto"
            >
              <Select
                style={{ width: 220 }}
                disabled="true"
                name="tipooperacion_cosv"
                placeholder="Seleccione Tipo de Operación"
                onChange={handleChanged}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.tipooperacion_cosv}
              >
                {
                  listarTipoOperacion && listarTipoOperacion.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_tope}>{itemselect.descripcion_tope}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>

        <Row justify="center"  >
          <Col span={8}>
            <Item
              label="Referencia"
            >
              <Input
                name='referencia_cosv'
                defaultValue={referencia}
                disabled="true"
                onChange={(e) => setReferencia(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.referencia_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={6}>
            <Item
              label="Falla Mtto"
            >
              <Select
                style={{ width: 220 }}
                name="tipooperacion_cosv"
                placeholder="Seleccione Falla de Mtto"
                onChange={seleccionarFallaMtto}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.tipooperacion_cosv}
              >
                {
                  listarTiposFallas && listarTiposFallas.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_tfa}>{itemselect.descripcion_tfa}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Tipo"
            >
              <Select
                style={{ width: 220 }}
                name="tipofallamtto_cosv"
                placeholder="Seleccione Tipo de Falla de Mtto"
                onChange={handleChanged}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.tipofallamtto_cosv}
              >
                {
                  listarFallasMtto && listarFallasMtto.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_fmt}>{itemselect.descripcion_fmt}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
        <Row justify="lef">
          <Col span={14}>
            <Item
              label="Actividad Realizada"
            >
              <Input
                name='descripcion_cosv'
                style={{ width: 800 }}
                onChange={(e) => setActividadrealizada(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.descripcion_cosv}
              ></Input>
            </Item>
          </Col>
        </Row>
        <Row justify="center">
          <Col span={8}>
            <Item
              label="Fecha Inicia"
            >
              <Input
                name='fechainicia_cosv'
                type="datetime"
                value={fechainicial}
                onChange={(e) => setFechainicial(e.target.value)}
                InputLabelProps={{ shrink: true }}
                defaultValue={Moment(cumplimientoSeleccionado.fechainicia_cosv).format('YYYY-MM-DD HH:mm:ss')}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.fechainicia_cosv}
              >
              </Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Fecha Finaliza"
            >
              <Input
                name='fechafinal_cosv'
                type="datetime"
                value={fechafinal}
                onChange={(e) => setFechafinal(e.target.value)}
                InputLabelProps={{ shrink: true }}
                defaultValue={Moment(cumplimientoSeleccionado.fechafinal_cosv).format('YYYY-MM-DD HH:mm:ss')}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.fechafinal_cosv}
              >
              </Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Servicio :"
            >
              <Select
                style={{ width: 220 }}
                name="servicio_cosv"
                defaultValue={servicio}
                placeholder="Seleccione Servicio Realizado"
                onChange={handleChanged}
                //onChange={(e) => setServicioRealizado(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.servicio_cosv}
              >
                {
                  listarActividadRealizada && listarActividadRealizada.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_are}>{itemselect.descripcion_are}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
        <Row justify="left">
          <Col span={8}>
            <Item
              label="Cantidad"
            >
              <Input
                name='cantidad_cosv'
                value={cantidad}
                onChange={(e) => setCantidad(e.target.value)}
                InputLabelProps={{ shrink: true }}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.cantidad_cosv}
              >
              </Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Valor Unitario"
            >
              <InputNumber
                name="valorunitario_cosv"
                defaultValue={valorunitario}
                decimalSeparator="."
                style={{ width: 210 }}
                formatter={value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                parser={value => value.replace(/\$\s?|(,*)/g, '')}
                onChange={(e) => setValorunitario(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.valorunitario_cosv}
              />
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Valor Total"
            >
              <InputNumber
                name="valortotal_cosv"
                defaultValue={0}
                decimalSeparator="."
                style={{ width: 210 }}
                formatter={value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                parser={value => value.replace(/\$\s?|(,*)/g, '')}
                onChange={(e) => setValorunitario(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.valorunitario_cosv}
              />
            </Item>
          </Col>
        </Row>
        <Row justify="left">
          <Col span={16}>
            <Item
              label="Observaciones"
            >
              <Input
                name="observacion_cosv"
                value={observacion}
                onClick={(e) => setObservacion(e.target.value)}
                value={cumplimientoSeleccionado && cumplimientoSeleccionado.observacion_cosv}
              ></Input>
            </Item>
          </Col>
          <Col span={8}>
            <Item
              label="Estado del Equipo"
            >
              <Select
                style={{ width: 220 }}
                name="estadooperacionequipo_cosv"
                placeholder="Estado del Equipo"
                defaultValue={cumplimientoSeleccionado.estadooperacionequipo_cosv}
                onChange={seleccionarEstadoOperacionEquipos}
              //onChange={(e) => setServicioRealizado(e.target.value)}
              //value={cumplimientoSeleccionado && cumplimientoSeleccionado.estadooperacionequipo_cosv}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_est}>{itemselect.nombre_est}</Option>
                    )
                  })
                }
              </Select>
            </Item>
          </Col>
        </Row>
      </Form>
    </div>
  )

  const revisarCumplimiento = (
    <div >
      <br />
      <MaterialTable
        columns={cumplimiento}
        data={listUnCumplimiento}
        title="REGISTRO CUMPLIMIENTO ORDEN DE SERVICIO"
        actions={[
          {
            icon: 'edit',
            tooltip: 'Editar Item',
            onClick: (event, rowData) => seleccionarCumplimiento(rowData, "Editar")
          },
          {
            icon: 'delete',
            tooltip: 'Eliminar Item',
            onClick: (event, rowData) => seleccionarCumplimiento(rowData, "Eliminar")
          },
          {
            icon: 'edit',
            tooltip: 'Agregar Observación',
            onClick: (event, rowData) => grabarObservacion(rowData, "Observacion")
          }
        ]}
        options={{
          actionsColumnIndex: -1,
          headerStyle: { backgroundColor: '#9e9e9e', fontSize: 16 },
          rowStyle: {
            fontSize: 14,
          }
        }}
        localization={{
          header: {
            actions: "Acciones"
          }
        }}

      />
    </div>
  )

  const grabarHorometro = (
    <div className="App">
      <Title align="center" type="warning" level={4}>
        INGRESAR VALOR DEL HOROMETRO # {props.ordenSeleccionado.codigo_equ}
      </Title>
      <Row justify="center">
        <Col span={6}>
          <Item
            label="Ingresar Valor del Horometro"
          >
            <Input
              name="id"
              type="number"
              onChange={(e) => setHorometro(e.target.value)}
            ></Input>
          </Item>
        </Col>
      </Row>
    </div>
  )

  const ActividadEliminar = (
    <div>
      <p>Estás seguro que deseas eliminar el Cumplimiento de la Orden <b>{cumplimientoSeleccionado && cumplimientoSeleccionado.id}</b>? </p>
      <div align="right">
        <Button onClick={() => borraActividadOrden()}> Confirmar </Button>
        <Button onClick={() => abrirCerrarModalEliminarActividad()}> Cancelar </Button>
      </div>
    </div>
  )

  const calificarServicioOT = (
    <div >
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />

      <Container className={styles.floatingbutton} >
        <Bottom
          tooltip="5 - Myy Bueno"
          rotate={true}
          styles={{ backgroundColor: darkColors.green, color: lightColors.white }}
          onClick={() => grabarCalificacionServicio(5)} ><SentimentVerySatisfiedIcon />
        </Bottom>
        <Bottom
          tooltip="4 - Bueno"
          rotate={true}
          styles={{ backgroundColor: darkColors.yellow, color: lightColors.white }}
          onClick={() => grabarCalificacionServicio(4)} ><SentimentSatisfiedIcon />
        </Bottom>
        <Bottom
          tooltip="3 - Regular"
          rotate={true}
          styles={{ backgroundColor: darkColors.blue, color: lightColors.white }}
          onClick={() => grabarCalificacionServicio(3)} ><SentimentDissatisfiedIcon />
        </Bottom>
        <Bottom
          tooltip="2 - Mal"
          rotate={true}
          styles={{ backgroundColor: darkColors.orange, color: lightColors.white }}
          onClick={() => grabarCalificacionServicio(2)} ><MoodBadSharpIcon />
        </Bottom>
        <Bottom
          tooltip="1 - Muy Mal"
          rotate={true}
          styles={{ backgroundColor: darkColors.red, color: lightColors.white }}
          onClick={() => grabarCalificacionServicio(1)} > < SentimentVeryDissatisfiedIcon />
        </Bottom>
        <Bottom
          tooltip="Calificar el servicio!"
          rotate={true}
          styles={{ backgroundColor: darkColors.lightBlue, color: lightColors.white }}
          onClick={() => alert('Seleccione La Calificacion del Servicio!')} ><ZoomOutMapIcon /></Bottom>
      </Container>
    </div>
  )

  return (
    <div>
      <Title align="center" type="warning" level={4}>
        ORDEN DE SERVICIO # {props.ordenSeleccionado.id_otr}
      </Title>
      <Title align="center" level={5}>
        EMPRESA : {nombre_emp}  &nbsp;&nbsp;&nbsp; CLIENTE : {razonsocial_cli}{" "} &nbsp;&nbsp;&nbsp; TELEFONO : {telefono_cli}
      </Title>

      <Title align="center" level={5}>
        CONTACTO :{primer_apellido_con} &nbsp;&nbsp;&nbsp; CIUDAD : {nombre_ciu} &nbsp;&nbsp;&nbsp; CORREO : {email_cli}
      </Title>

      <Title align="center" level={5}>
        MARCA : {descripcion_mar} &nbsp;&nbsp;&nbsp; MODELO : {modelo_dequ} &nbsp;&nbsp;&nbsp; FECHA : {fechainicia_otr}
      </Title>

      <Title align="center" level={5}>
        SERIE : {serie_dequ} &nbsp;&nbsp;&nbsp; ID INTERNO : {codigo_equ}
      </Title>

      <Title align="center" level={5}>
        TIPO DE SERVICIO : {descripcion_tser} &nbsp;&nbsp; TIPO DE ACTIVIDAD : {descripcion_tmt}
      </Title>

      <Row justify="center" >
        <Col span={12}>
          <Button type="primary" onClick={() => iniciarTransporte()} > INICIA TRANSPORTE : {fechaIniciaTransporte} </Button>
        </Col>
        <Col span={10}>
          <Button type="primary" > FINALIZA TRANSPORTE : {fechaFinalTransporte} </Button>
        </Col>

      </Row>

      <Row justify="center">
        <Col span={8}>
          <Button type="primary" > TIEMPO DE TRANSPORTE : {tiempoTransporte} </Button>
        </Col>
        <Col span={6}>
          <Button className="transporte" type="primary" align="center" onClick={() => abrirModalGrabarHorometro()} > HOROMETRO : {horometro} </Button>
        </Col>
        <Col span={6}>
          <Button type="primary" > TIEMPO ACTIVIDAD : {tiempoorden_otr} </Button>
        </Col>
      </Row>

      <Row justify="center">
        <div>
          <Button className="button" icon={<FileAddOutlined />} onClick={() => iniciarCumplimiento()} >Iniciar Actividad </Button>
          <Button className="button1" icon={<FileAddOutlined />} onClick={() => agregarCumplimientoOperacion()} >Diligenciar OT</Button>
          <Button className="button2" icon={<PictureOutlined />} onClick={() => openModalFotos()} >Agregar Fotos </Button>
          <Button className="button6" icon={<SwitcherOutlined />} onClick={() => abrirModalNombreCargo()} >Nombre y Cargo </Button>
        
        </div>
      </Row>
      <Row justify="center">
        <div>
        <Button className="button3" icon={<HighlightOutlined />} onClick={() => FirmarOrden()} >Firmar OT </Button>
        <Button className="button6" icon={<SwitcherOutlined />} onClick={() => calificarServicio()} >Calificar Servicio </Button>
          <Button className="button4" icon={<CheckSquareOutlined />} onClick={() => consultarCumplimiento()} >Revisar Cumplimiento </Button>
          <Button className="button5" icon={<SwitcherOutlined />} onClick={() => pasarARevision()} >Pasar a Revisión </Button>
        </div>
      </Row>

      <Modal title="CUMPLIMIENTO OT" visible={modalEditar} onOk={cerrarModalEditar} width={1200} closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalEditar} > Cancelar </Button>,
          <Button type="primary" onClick={grabarCumplimiento} > Enviar </Button>
        ]}
      >
        {CumplimientoOrden}
      </Modal>

      <Modal
        title="CONSULTAR CUMPLIMIENTO OT" visible={modalRevisarCumplimiento}
        onOk={cerrarModalRevisarCumplimiento}
        width={1250}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalRevisarCumplimiento} > Cancelar </Button>,
        ]}
      >
        {revisarCumplimiento}
      </Modal>

      <Modal
        title="ACTUALIZAR CUMPLIMIENTO OT" visible={modalActualizarCumplimiento}
        onOk={cerrarModalActualizarCumplimiento}
        width={1250}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalActualizarCumplimiento} > Cancelar </Button>,
          <Button type="primary" onClick={guardarCambiosCumplimiento} > Enviar </Button>
        ]}
      >
        {actualizarCumplimiento}
      </Modal>

      <Modal
        title="CERRAR OT" visible={modalCerrarOrden}
        onOk={cerrarModalCerrarOrden}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalCerrarOrden} > Cancelar </Button>,
          <Button type="primary" onClick={cerrarOrden} > Enviar </Button>
        ]}
      >
        <div >
          <p>Estás seguro que desea Cerrar la Orden de Servicio <b> {id_otr} </b>? </p>
        </div>
      </Modal>

      <Modal
        title="REGISTRO FOTOS OT" visible={modalFotos}
        onOk={cerrarModalFoto}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalFoto} > Cancelar </Button>,
        ]}
      >
        <Images numeroorden={id_otr} operario={operario} />
      </Modal>

      <Modal
        title="FIRMAR OT" visible={modalFirmarOT}
        onOk={cerrarModalFoto}
        width={800}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalFirmarOT} > Cancelar </Button>,
        ]}
      >
        <FirmarOT id_otr={id_otr} />
      </Modal>

      <Modal
        title="GRABAR HOROMETRO" visible={modalGrabarHorometro}
        onOk={cerrarModalGrabarHorometro}
        width={1000}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalGrabarHorometro} > Cancelar </Button>,
          <Button type="primary" onClick={grabarValorHorometro} > Enviar </Button>
        ]}
      >
        {grabarHorometro}
      </Modal>

      <Modal
        title="NOMBRE Y CARGO FUNCIONARIO" visible={modalNombreCargo}
        onOk={cerrarModalNombreCargo}
        width={1000}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalNombreCargo} > Cancelar </Button>,
        ]}
      >
        <NombreCargoOT id_otr={id_otr} />
      </Modal>

      <Modal
        title="CALIFICAR SERVICIO" visible={modalCalificarServicio}
        onOk={cerrarModalCalificarServicio}
        width={400}
        high={400}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalCalificarServicio} > Cancelar </Button>,
        ]}
      >
        {calificarServicioOT}
      </Modal>
    </div>
  );
}

export default RegistroActividadesOperario;
