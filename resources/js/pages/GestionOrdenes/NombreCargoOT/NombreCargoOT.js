import React, { useEffect, useState } from "react";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import { FileAddOutlined, PictureOutlined, CheckSquareOutlined, CloseSquareOutlined, SwitcherOutlined, HighlightOutlined } from '@ant-design/icons';

import swal from 'sweetalert';
//import './NombreCargo.css';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

// Componentes de Conexion con el Backend
import nombrecargootServices from "../../../services/Mantenimiento/NombreCargoOT";
import ordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";

function NombreCargoOT(props) {
  const { id_actividad } = props;
  //console.log("ID ACTIVIDAD : ", id_actividad)

  const [listNombreCargoOT, setListNombreCargoOT] = useState([]);
  const [modalInsertarNombreCargo, setModalInsertarNombreCargo] = useState(false);
  const [modalEditarNombreCargo, setModalEditarNombreCargo] = useState(false);
  const [formError, setFormError] = useState(false);
  const [grabar, setGrabar] = useState(false);
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

  const seleccionarNombreCargo = (pendiente, caso) => {
    setNombreCargoOTSeleccionado(pendiente);
    (caso === "Editar") ? abrirCerrarModalEditar() : abrirCerrarModalEliminar()
  }

  const abrirModalInsertarNombreCargo = () => {
    setModalInsertarNombreCargo(true);
  }

  const cerrarModalInsertarNombreCargo = () => {
    setModalInsertarNombreCargo(false);
  }

  const abrirModalEditarNombreCargo = () => {
    setModalEditarNombreCargo(true);
  }

  const cerrarModalEditarNombreCargo = () => {
    setModalEditarNombreCargo(false);
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

    const res = await nombrecargootServices.delete(nombreCargoOTSeleccionado.id);

    if (res.success) {
      swal({
        title: "Nombre y Cargo",
        text: "Nombre y Cargo Borrado de forma Correcta!",
        icon: "success",
        button: "Aceptar"
      });
      console.log(res.message)
      abrirCerrarModalEliminar();
    }
    else {
      swal({
        title: "Nombre y Cargo",
        text: "Error Borrando Nombre y Cargo Borrado!",
        icon: "success",
        button: "Aceptar"
      });
      console.log(res.message);
      abrirCerrarModalEliminar();
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

  const nombreCargoInsertar = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Ingresar Nombre y Cargo Funcionario
      </Title>

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
      </Form>
    </div>
  )

  const nombreCargoEditar = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Modificar Nombre y Cargo Funcionario
      </Title>

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
      </Form>
    </div>
  )

  const unidadEliminar = (
    <div className="App">
      console.log("ELIMINAR")
    </div>
  )

  return (
    <div className="App">
      <br />
      <Row justify="center">
        <div>
          <Button className="button" icon={<FileAddOutlined />} onClick={() => abrirModalInsertarNombreCargo()} >Insertar Nombre y Cargo </Button>
          <Button className="button1" icon={<FileAddOutlined />} onClick={() => abrirModalEditarNombreCargo()} >Modificar Nombre y Cargo</Button>
          <Button className="button2" icon={<PictureOutlined />} onClick={() => openModalFotos()} >Borrar Nombre y Cargo </Button>
        </div>
      </Row>
      <Modal
        title="INSERTAR NOMBRE Y CARGO" visible={modalInsertarNombreCargo}
        onOk={cerrarModalInsertarNombreCargo}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalInsertarNombreCargo} > Cancelar </Button>,
          <Button type="primary" onClick={grabaNombreCargo} > Enviar </Button>
        ]}
      >
        {nombreCargoInsertar}
      </Modal>

      <Modal
        title="MODIFICAR NOMBRE Y CARGO" visible={modalEditarNombreCargo}
        onOk={cerrarModalEditarNombreCargo}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalEditarNombreCargo} > Cancelar </Button>,
          <Button type="primary"  > Enviar </Button>
        ]}
      >
        {nombreCargoEditar}
      </Modal>
    </div>
  );
}

export default NombreCargoOT;