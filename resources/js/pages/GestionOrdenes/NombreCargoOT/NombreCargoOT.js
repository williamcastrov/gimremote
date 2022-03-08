import React, { useEffect, useState } from "react";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import { FileAddOutlined, PictureOutlined, CheckSquareOutlined, CloseSquareOutlined, SwitcherOutlined, HighlightOutlined } from '@ant-design/icons';
import "bootstrap/dist/css/bootstrap.min.css";
import { makeStyles } from "@material-ui/core/styles";
import 'antd/dist/antd.css';
import PropTypes from 'prop-types';
import { Button as Botton } from "react-bootstrap";
import ZoomOutMapIcon from '@material-ui/icons/ZoomOutMap';
import FirmarOT from "../FirmarOT/";
// Floating Button
import { Container, Button as Bottom, Link, lightColors, darkColors } from 'react-floating-action-button';
import swal from 'sweetalert';
import './NombreCargo.css';
import MoodBadSharpIcon from '@material-ui/icons/MoodBadSharp';
import SentimentVeryDissatisfiedIcon from '@material-ui/icons/SentimentVeryDissatisfied';
import SentimentDissatisfiedIcon from '@material-ui/icons/SentimentDissatisfied';
import SentimentSatisfiedIcon from '@material-ui/icons/SentimentSatisfied';
import SentimentVerySatisfiedIcon from '@material-ui/icons/SentimentVerySatisfied';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

// Componentes de Conexion con el Backend
import nombrecargootServices from "../../../services/Mantenimiento/NombreCargoOT";
import ordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";
import cumplimientooservServices from "../../../services/GestionOrdenes/CumplimientoOserv";
import calificacionserviciootServices from "../../../services/GestionOrdenes/CalificacionServicioOT";

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

function NombreCargoOT(props) {
  const { id_actividad, estado_otr } = props;
  //console.log("ID ACTIVIDAD : ", id_actividad)

  const styles = useStyles();
  const [listNombreCargoOT, setListNombreCargoOT] = useState([]);
  const [modalInsertarNombreCargo, setModalInsertarNombreCargo] = useState(true);
  const [modalEditarNombreCargo, setModalEditarNombreCargo] = useState(false);
  const [formError, setFormError] = useState(false);
  const [grabar, setGrabar] = useState(false);
  const [descripcionActividad, setDescripcionActividad] = useState(null);
  const [modalFirmarOT, setModalFirmarOT] = useState(false);
  const [modalCalificarServicio, setModalCalificarServicio] = useState(false);
  const [grabarCalificacionOT, setGrabarCalificacionOT] = React.useState(false);
  const [nombreCargoOTSeleccionado, setNombreCargoOTSeleccionado] = useState({
    ot_ncot: "",
    nombrerecibe_ncot: "",
    cargorecibe_ncot: ""
  });

  const [calificacionServicioOTSeleccionado, setCalificacionServicioOTSeleccionado] = useState({
    ot_cse: "",
    valorservicio_cse: 0
  });

  useEffect(() => {
    async function fetchDataNombreCargoOT() {
      const res = await nombrecargootServices.listunnombrecargoot();
      setListNombreCargoOT(res.data);
    }
    fetchDataNombreCargoOT();
  }, [])

  const handleChange = e => {
    const { name, value } = e.target;

    setNombreCargoOTSeleccionado(prevState => ({
      ...prevState,
      [name]: value
    }));
  }

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
              ot_cse: id_actividad,
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
        //console.log("DATOS CALIFICACION SERVICIO : ", calificacionServicioOTSeleccionado[0])

        const res = await calificacionserviciootServices.save(calificacionServicioOTSeleccionado[0]);

        if (res.success) {
          swal("Calificación Servicio", "Grabado de forma Correcta!", "success", { button: "Aceptar" });
          console.log(res.message)
        } else {
          swal("Calificación Servicio", "Error Grabando Calificación!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabarCalificacion(false);
      }
    }
    grabarCalificacion();
  }, [grabarCalificacionOT])


  useEffect(() => {
    async function fetchDataUnCumplimiento() {
      const res = await cumplimientooservServices.leeractividad(id_actividad);
      console.log("DATOS ACTIVIDAD : ", res.data[0].descripcion_cosv);
      setDescripcionActividad(res.data[0].descripcion_cosv);
    }
    fetchDataUnCumplimiento();
  }, [])

  const cerrarModalInsertarNombreCargo = () => {
    setModalInsertarNombreCargo(false);
  }

  const abrirModalFirmarOT = () => {
    setModalFirmarOT(true);
  }

  const cerrarModalFirmarOT = () => {
    setModalFirmarOT(false);
  }

  const abrirModalCalificarServicio = () => {
    setModalCalificarServicio(true);
  }

  const cerrarModalCalificarServicio = () => {
    setModalCalificarServicio(false);
  }

  const calificarServicio = () => {
    abrirModalCalificarServicio()
  }

  const grabaNombreCargo = async () => {

    setFormError({});
    let errors = {};
    let formOk = true;

    if (!nombreCargoOTSeleccionado.nombrerecibe_ncot) {
      alert("1")
      errors.nombrerecibe_ncot = true;
      formOk = false;
    }

    if (!nombreCargoOTSeleccionado.cargorecibe_ncot) {
      alert("2")
      errors.cargorecibe_ncot = true;
      formOk = false;
    }

    setFormError(errors);

    if (!formOk) {
      //console.log(equiposSeleccionado);
      swal("Nombre y Cargo", "Debe Ingresar Todos los Datos, Error el Registro!", "warning", { button: "Aceptar" });
      //console.log(equiposSeleccionado);
      //console.log(res.message);
      abrirCerrarModalInsertar();
    }

    {
      setNombreCargoOTSeleccionado([{
        ot_ncot: id_actividad,
        nombrerecibe_ncot: nombreCargoOTSeleccionado.nombrerecibe_ncot,
        cargorecibe_ncot: nombreCargoOTSeleccionado.cargorecibe_ncot
      }]);
    }
    setGrabar(true);
  }

  useEffect(() => {
    async function grabarNombreCargo() {

      if (grabar) {
        console.log("NOMBRE CARGO : ", nombreCargoOTSeleccionado)

        const res = await nombrecargootServices.save(nombreCargoOTSeleccionado[0]);

        if (res.success) {

          swal("Nombre y Cargo", "Nombre y Cargo Creado de forma Correcta!", "success", { button: "Aceptar" });

          console.log(res.message)
        } else {
          swal("Nombre y Cargo", "Error Creando Nombre y Cargo!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabar(false);
        cerrarModalInsertarNombreCargo();
      }
    }
    grabarNombreCargo();
  }, [grabar])

  const borrarNombreCargo = async () => {

    swal({
      title: "LOGISTRAL S.A.",
      text: "Oprima OK para Eliminar nombre y cargo del funcionario!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willDelete) => {
        const borrar = async () => {
          const res = await nombrecargootServices.delete(id_actividad);

          if (res.success) {
            if (willDelete) {
              swal({
                title: "Nombre y Cargo",
                text: "Nombre y Cargo Borrado de forma Correcta!",
                icon: "success",
                button: "Aceptar"
              });
            } else {
              swal({
                title: "Nombre y Cargo",
                text: "Error Borrando Nombre y Cargo!",
                icon: "success",
                button: "Aceptar"
              });
            }
          }
        }
        borrar();
      });
  }

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
          tooltip="5 - Muy Bueno"
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


  const FirmarOrden = () => {
    //console.log("DATOS ORDEN : ", orden)
    if (estado_otr === 24 || estado_otr === 27 || estado_otr === 32) {
      swal("Cumplimiento OT", "El estado de la OT no permite cambios", "warning", { button: "Aceptar" });
    } else {
      abrirModalFirmarOT()
    }
  }
  // "string","boolean","numeric","date","datetime","time","currency"
  const columnas = [
    {
      title: '#Orden',
      field: 'ot_ncot'
    },
    {
      title: 'Nombre Funcionario',
      field: 'nombrerecibe_ncot'
    },
    {
      title: 'Cargo Funcionario',
      field: 'cargorecibe_ncot',
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

  return (
    <div className="App">
      <Form {...layout} >
        <Row justify="center" >
          <Col span={18}>
            <Item
              label="Nombre Funcionario"
            >
              <Input
                style={{ width: 220 }}
                name='nombrerecibe_ncot'
                onChange={handleChange}
                value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.nombrerecibe_ncot}
              ></Input>
            </Item>
          </Col>
        </Row>
        <Row justify="center" >
          <Col span={18}>
            <Item
              label="Cargo Funcionario"
            >
              <Input
                style={{ width: 220 }}
                name='cargorecibe_ncot'
                onChange={handleChange}
                value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.cargorecibe_ncot}
              ></Input>
            </Item>
          </Col>
        </Row>
        {
          descripcionActividad ?
            <p className="texto" align="center" >
              {descripcionActividad}
            </p>
            :
            null

        }

        <div align="right">
          <Row justify="center">
            <Col lg={2}>
              <Botton className="botoncargo" type="primary" color="primary" onClick={() => grabaNombreCargo()}>
                Grabar
              </Botton>
            </Col>
            <Col lg={1}>
            </Col>
            <Col lg={2}>
              <Botton className="botoneliminar" type="primary" color="primary" onClick={() => borrarNombreCargo()}>
                Eliminar
              </Botton>
            </Col>
            <Col lg={1}></Col>
            <Col lg={2}>
              <Botton className="botoncargo" type="primary" color="primary" onClick={() => FirmarOrden()}>
                Firmar OT
              </Botton>
            </Col>
            <Col lg={1}></Col>
            <Col lg={2}>
              <Botton className="botoncargo" type="primary" color="primary" onClick={() => calificarServicio()}>
                Calificar
              </Botton>
            </Col>
          </Row>
        </div>
      </Form>
      <Modal
        title="FIRMAR OT" visible={modalFirmarOT}
        onOk={cerrarModalFirmarOT}
        width={800}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalFirmarOT} > Regresar </Button>,
        ]}
      >
        <FirmarOT id_actividad={id_actividad} />
      </Modal>
      <Modal
        title="CALIFICAR SERVICIO" visible={modalCalificarServicio}
        onOk={cerrarModalCalificarServicio}
        width={400}
        high={400}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalCalificarServicio} > Regresar </Button>,
        ]}
      >
        {calificarServicioOT}
      </Modal>
    </div>
  );
}

export default NombreCargoOT;