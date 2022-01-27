import React, { useEffect, useState } from "react";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import { FileAddOutlined, PictureOutlined, CheckSquareOutlined, CloseSquareOutlined, SwitcherOutlined, HighlightOutlined } from '@ant-design/icons';
import "bootstrap/dist/css/bootstrap.min.css";
import { Button as Botton } from "react-bootstrap";

import swal from 'sweetalert';
import './NombreCargo.css';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

// Componentes de Conexion con el Backend
import nombrecargootServices from "../../../services/Mantenimiento/NombreCargoOT";
import ordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";
import cumplimientooservServices from "../../../services/GestionOrdenes/CumplimientoOserv";

function NombreCargoOT(props) {
  const { id_actividad } = props;
  //console.log("ID ACTIVIDAD : ", id_actividad)

  const [listNombreCargoOT, setListNombreCargoOT] = useState([]);
  const [modalInsertarNombreCargo, setModalInsertarNombreCargo] = useState(true);
  const [modalEditarNombreCargo, setModalEditarNombreCargo] = useState(false);
  const [formError, setFormError] = useState(false);
  const [grabar, setGrabar] = useState(false);
  const [descripcionActividad, setDescripcionActividad] = useState(null);
  const [nombreCargoOTSeleccionado, setNombreCargoOTSeleccionado] = useState({
    ot_ncot: "",
    nombrerecibe_ncot: "",
    cargorecibe_ncot: ""
  })

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
          alert("ENTRE")
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
                text: "Error Borrando Nombre y Cargo Borrado!",
                icon: "success",
                button: "Aceptar"
              });
            }
          }
        }
        borrar();
      });
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
            <Col lg={3}>
              <Botton className="botoncargo" type="primary" color="primary" onClick={() => grabaNombreCargo()}>
                Grabar
              </Botton>
            </Col>
            <Col lg={1}>
            </Col>
            <Col lg={3}>
              <Botton className="botoncargo" type="primary" color="primary" onClick={() => borrarNombreCargo()}>
                Eliminar
              </Botton>
            </Col>
          </Row>
        </div>
      </Form>
    </div>
  );
}

export default NombreCargoOT;