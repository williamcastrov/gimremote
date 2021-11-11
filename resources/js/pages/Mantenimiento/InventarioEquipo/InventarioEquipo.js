import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import { Modal, Button, Form, Input, Typography, Row, Col, Select, InputNumber } from "antd";
import { FileAddOutlined, PictureOutlined, CheckSquareOutlined, CloseSquareOutlined, SwitcherOutlined, HighlightOutlined } from '@ant-design/icons';
import Moment from 'moment';
import swal from 'sweetalert';
import './InventarioEquipo.css';

const { Item } = Form;
const { Password } = Input;
const { Title } = Typography;

// Componentes de Conexion con el Backend
import inventarioEquipoServices from "../../../services/Mantenimiento/InventarioEquipo";
import ordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";
import equiposServices from "../../../services/Mantenimiento/Equipos";
import estadosServices from "../../../services/Mantenimiento/EstadosCalidad";

function InventarioEquipo(props) {
  const { id_otr } = props;

  const [listComponenteInventario, setListComponenteInventario] = useState([]);
  const [modalInsertarInventarioEquipo, setModalInsertarInventarioEquipo] = useState(false);
  const [modalEquipos, setModalEquipos] = useState(false);
  const [modalEditarInventarioEquipo, setModalEditarInventarioEquipo] = useState(false);
  const [modalModificarInventarioEquipo, setModalModificarInventarioEquipo] = useState(false);
  const [modalEliminarInventarioEquipo, setModalEliminarInventarioEquipo] = useState(false);
  const [modalConsultarInventarioEquipo, setModalConsultarInventarioEquipo] = useState(false);

  const [formError, setFormError] = useState(false);
  const [grabar, setGrabar] = useState(false);
  const [controlaGrabar, setControlaGrabar] = useState(false);
  const [modifica, setModifica] = useState(false);
  const [idEquipo, setIdEquipo] = useState(0);
  const [nombreEquipo, setNombreEquipo] = useState([]);
  const [listarUnEquipo, setListarUnEquipo] = useState([]);
  const [listarEquipos, setListarEquipos] = useState([]);
  const [listarEquiposCargadores, setListarEquiposCargadores] = useState([]);
  const [listarEquiposBaterias, setListarEquiposBaterias] = useState([]);
  const fechaactual = Moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
  const [listarEstados, setListarEstados] = useState([]);

  const [cargador, setEstadoCargador] = useState(0);
  const [bateria, setEstadoBateria] = useState(0);

  const [estadoOperacionEquipos, setEstadoOperacionEquipos] = useState(0);
  const [estadoOperacionCargador, setEstadoOperacionCargador] = useState(0);
  const [estadoOperacionBateria, setEstadoOperacionBateria] = useState(0);

  const [componenteInventarioSeleccionado, setComponenteInventarioSeleccionado] = useState({
    id_inve: 0,
    fechainventario_inve: fechaactual,
    codigoequipo_inve: "",
    serieequipo_inve: "",
    estadoequipo_inve: "",
    observacionequipo_inve: "",
    codigobateria_inve: "",
    seriebateria_inve: "",
    estadobateria_inve: "",
    observacionbateria_inve: "",
    codigocargador_inve: "",
    seriecargador_inve: "",
    estadocargador_inve: "",
    observacioncargador_inve: ""
  })

  const leerInventarioEquipo = () => {
    async function fetchDataComponenteInventario() {
      console.log("ID EQUIPO  : ", idEquipo)
      const res = await inventarioEquipoServices.leerinventarioequipo(idEquipo);
      console.log("COMPONENTES EQUIPOS : ", res.data)
      setListComponenteInventario(res.data);
    }
    fetchDataComponenteInventario();
    abrirModalConsultarInventarioEquipo();
  }

  useEffect(() => {
    async function fetchDataEquipos() {
      const res = await equiposServices.listEquiposMontacargas();
      console.log("EQUIPOS : ", res.data)
      setListarEquipos(res.data);
    }
    fetchDataEquipos();
  }, [])

  useEffect(() => {
    async function fetchDataAccesoriosCargadores() {
      const res = await equiposServices.listEquiposAccesoriosCargadores();
      console.log("CARGADORES EQUIPOS : ", res.data)
      setListarEquiposCargadores(res.data);
    }
    fetchDataAccesoriosCargadores();
  }, [])

  useEffect(() => {
    async function fetchDataAccesoriosBaterias() {
      const res = await equiposServices.listEquiposAccesoriosBaterias();
      console.log("BATERIAS EQUIPOS : ", res.data)
      setListarEquiposBaterias(res.data);
    }
    fetchDataAccesoriosBaterias();
  }, [])

  useEffect(() => {
    async function fetchDataEstados() {
      const res = await estadosServices.listEstadosCalidad();
      setListarEstados(res.data);
      //console.log("ESATDOS : ", res.data)
    }
    fetchDataEstados();
  }, [])

  const handleChange = e => {
    const { name, value } = e.target;

    setComponenteInventarioSeleccionado(prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  function seleccionarEstadoOperacionEquipos(value) {
    setEstadoOperacionEquipos(value);
  }

  function seleccionarEstadoOperacionCargador(value) {
    setEstadoOperacionCargador(value);
  }

  function seleccionarEstadoOperacionBateria(value) {
    setEstadoOperacionBateria(value);
  }

  function seleccionarCargador(value) {
    setEstadoCargador(value);
  }

  function seleccionarBateria(value) {
    setEstadoBateria(value);
  }

  const seleccionarInventarioEquipo = (inventario, caso) => {
    setComponenteInventarioSeleccionado(inventario);
    (caso === "Editar") ? abrirModalModificarInventarioEquipo() : abrirModalEliminarInventarioEquipo()
  }

  const abrirModalInsertarInventarioEquipo = () => {
    setModalInsertarInventarioEquipo(true);
  }

  const cerrarModalInsertarInventarioEquipo = () => {
    setModalInsertarInventarioEquipo(false);
  }

  const abrirModalEditarInventarioEquipo = () => {
    setModalEditarInventarioEquipo(true);
  }

  const cerrarModalEditarInventarioEquipo = () => {
    setModalEditarInventarioEquipo(false);
  }

  const abrirModalEliminarInventarioEquipo = () => {
    setModalEliminarInventarioEquipo(true);
  }

  const cerrarModalEliminarInventarioEquipo = () => {
    setModalEliminarInventarioEquipo(false);
  }

  const abrirModalConsultarInventarioEquipo = () => {
    setModalConsultarInventarioEquipo(true);
  }

  const cerrarModalConsultarInventarioEquipo = () => {
    setModalConsultarInventarioEquipo(false);
  }

  const abrirModalModificarInventarioEquipo = () => {
    setModalModificarInventarioEquipo(true);
  }

  const cerrarModalModificarInventarioEquipo = () => {
    setModalModificarInventarioEquipo(false);
  }

  const abrirModalEquipos = () => {
    setModalEquipos(true);
  }

  const cerrarModalEquipos = () => {
    setModalEquipos(false);
  }

  const grabaInventarioEquipo = async () => {
    console.log("ESTADO OPERACION EQUIPO", estadoOperacionEquipos);

    setFormError({});
    let errors = {};
    let formOk = true;

    if (idEquipo === 0) {
      alert("1")
      errors.codigoequipo_inve = true;
      formOk = false;
    }

    if (!componenteInventarioSeleccionado.serieequipo_inve) {
      alert("2")
      errors.serieequipo_inve = true;
      formOk = false;
    }

    if (componenteInventarioSeleccionado.estadoequipo_inve) {
      alert("3")
      errors.estadoequipo_inve = true;
      formOk = false;
    }

    setFormError(errors);

    if (!formOk) {
      //console.log(equiposSeleccionado);
      swal("Inventario Equipo", "Debe Ingresar Todos los Datos, Error el Registro!", "warning", { button: "Aceptar" });
      //console.log(equiposSeleccionado);
      //console.log(res.message);
      cerrarModalInsertarInventarioEquipo();
    }

    {
      setComponenteInventarioSeleccionado([{
        fechainventario_inve: fechaactual,
        codigoequipo_inve: idEquipo,
        serieequipo_inve: componenteInventarioSeleccionado.serieequipo_inve,
        estadoequipo_inve: estadoOperacionEquipos,
        observacionequipo_inve: componenteInventarioSeleccionado.observacionequipo_inve,
        codigobateria_inve: bateria,
        seriebateria_inve: componenteInventarioSeleccionado.seriebateria_inve,
        estadobateria_inve: estadoOperacionBateria,
        observacionbateria_inve: componenteInventarioSeleccionado.observacionbateria_inve,
        codigocargador_inve: cargador,
        seriecargador_inve: componenteInventarioSeleccionado.seriecargador_inve,
        estadocargador_inve: estadoOperacionCargador,
        observacioncargador_inve: componenteInventarioSeleccionado.observacioncargador_inve
      }]);
    }
    setGrabar(true);
  }

  useEffect(() => {
    async function grabarInventarioEquipo() {

      if (grabar) {
        console.log("INVENTARIO EQUIPO : ", componenteInventarioSeleccionado[0])

        const res = await inventarioEquipoServices.save(componenteInventarioSeleccionado[0]);

        if (res.success) {

          swal("Inventario Equipo", "Inventario Equipo Creado de forma Correcta!", "success", { button: "Aceptar" });
          setControlaGrabar(true);
          console.log(res.message)
        } else {
          swal("Inventario Equipo", "Error Creando Inventario Equipo!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabar(false);
        //cerrarModalInsertarInventarioEquipo();
      }
    }
    grabarInventarioEquipo();
  }, [grabar])

  function DatosEquipos(value) {
    console.log("CODIGO EQUIPO : ", value)
    setIdEquipo(value);
    async function fetchLeerDatoEquipo() {
      const res = await equiposServices.listUnEquipo(value);
      setListarUnEquipo(res.data);
      setNombreEquipo(res.data[0].codigo_equ)
      console.log("DATOS DEL EQUIPO SELECCIONADO : ", res.data)
    }
    fetchLeerDatoEquipo();
  }

  const actualizarInventarioEquipo = async () => {
    console.log("ESTADO OPERACION EQUIPO", estadoOperacionEquipos);

    setFormError({});
    let errors = {};
    let formOk = true;

    if (!componenteInventarioSeleccionado.codigoequipo_inve) {
      alert("1")
      errors.codigoequipo_inve = true;
      formOk = false;
    }

    if (!componenteInventarioSeleccionado.serieequipo_inve) {
      alert("2")
      errors.serieequipo_inve = true;
      formOk = false;
    }
/*
    if (componenteInventarioSeleccionado.estadoequipo_inve) {
      alert("3")
      errors.estadoequipo_inve = true;
      formOk = false;
    }
*/
    setFormError(errors);

    if (!formOk) {
      //console.log(equiposSeleccionado);
      swal("Inventario Equipo", "Debe Ingresar Todos los Datos, Error el Registro!", "warning", { button: "Aceptar" });
      //console.log(equiposSeleccionado);
      //console.log(res.message);
      cerrarModalInsertarInventarioEquipo();
    }

    {
      let estado = 0;
      if (estadoOperacionEquipos != 0)
        estado = estadoOperacionEquipos;
      else
        estado = componenteInventarioSeleccionado.estado_inve;

      setComponenteInventarioSeleccionado([{
        id_inve: componenteInventarioSeleccionado.id_inve,
        fechainventario_inve: componenteInventarioSeleccionado.fechainventario_inve,
        codigoequipo_inve: componenteInventarioSeleccionado.codigoequipo_inve,
        serieequipo_inve: componenteInventarioSeleccionado.serieequipo_inve,
        estadoequipo_inve: componenteInventarioSeleccionado.estadoequipo_inve,
        observacionequipo_inve: componenteInventarioSeleccionado.observacionequipo_inve,
        codigobateria_inve: componenteInventarioSeleccionado.codigobateria_inve,
        seriebateria_inve: componenteInventarioSeleccionado.seriebateria_inve,
        estadobateria_inve: componenteInventarioSeleccionado.estadobateria_inve,
        observacionbateria_inve: componenteInventarioSeleccionado.observacionbateria_inve,
        codigocargador_inve: componenteInventarioSeleccionado.codigocargador_inve,
        seriecargador_inve: componenteInventarioSeleccionado.seriecargador_inve,
        estadocargador_inve: componenteInventarioSeleccionado.estadocargador_inve,
        observacioncargador_inve: componenteInventarioSeleccionado.observacioncargador_inve
      }]);
    }
    setModifica(true);
  }

  useEffect(() => {
    async function modificaInventarioEquipo() {

      if (modifica) {
        console.log("INVENTARIO EQUIPO : ", componenteInventarioSeleccionado[0])
        
                const res = await inventarioEquipoServices.update(componenteInventarioSeleccionado[0]);
        
                if (res.success) {
                  swal("Inventario Equipo", "Inventario Equipo Actualizado de forma Correcta!", "success", { button: "Aceptar" });
                  console.log(res.message)
                } else {
                  swal("Inventario Equipo", "Error Actualizando Inventario Equipo!", "error", { button: "Aceptar" });
                  console.log(res.message);
                }
                setModifica(false);
                cerrarModalModificarInventarioEquipo();
      }
    }
    modificaInventarioEquipo();
  }, [modifica])

  const borrarInventarioEquipo = async () => {

    const res = await inventarioEquipoServices.delete(componenteInventarioSeleccionado.id_inve);

    if (res.success) {
      swal({
        title: "Inventario Equipo",
        text: "Inventario Equipo Borrado de forma Correcta!",
        icon: "success",
        button: "Aceptar"
      });
      console.log(res.message)
      abrirCerrarModalEliminar();
    }
    else {
      swal({
        title: "Inventario Equipo",
        text: "Error Borrando Inventario Equipo Borrado!",
        icon: "success",
        button: "Aceptar"
      });
      console.log(res.message);
      abrirCerrarModalEliminar();
    }

  }

  const columnas = [
    {
      title: 'Fecha Inventario',
      field: 'fechainventario_inve'
    },
    {
      title: 'ID Equipo',
      field: 'codigo_equ'
    },
    {
      title: 'Serie Equipo',
      field: 'serieequipo_inve',
    },
    {
      title: 'Estado Equipo',
      field: 'nombre_estcal',
    },
    {
      title: 'ID Cargador',
      field: 'codcargador'
    },
    {
      title: 'Serie Cargador',
      field: 'seriecargador_inve',
    },
    {
      title: 'Estado Cargador',
      field: 'estadocargador',
    },
    {
      title: 'ID Batería',
      field: 'codbateria'
    },
    {
      title: 'Serie Bateria',
      field: 'seriebateria_inve',
    },
    {
      title: 'Estado Batería',
      field: 'estadobateria',
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

  const inventarioEquipoInsertar = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Grabar Componentes Inventario Equipo
      </Title>
      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Registrar Inventario Equipo"
            >
              <Input
                style={{ width: 110 }}
                name='codigoequipo_inve'
                onChange={handleChange}
                disabled="true"
                defaultValue={idEquipo}
              ></Input>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                defaultValue={nombreEquipo}
              ></Input>
              <Input
                placeholder="Ingrese Serie"
                style={{ width: 220 }}
                name='serieequipo_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.serie_inve}
              ></Input>
              <Select
                placeholder="Seleccione Estado Equipo"
                style={{ width: 220 }}
                name="estadoequipo_inve"
                onChange={seleccionarEstadoOperacionEquipos}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.estado_inve}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                placeholder="Ingrese Observaciones del Equipo"
                style={{ width: 660 }}
                name='observacionequipo_inve'
                onChange={handleChange}
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>

      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Inventario Cargador Batería"
            >
              <Select
                placeholder="ID Cargador Bateria"
                style={{ width: 110 }}
                name="codigocargador_inve"
                placeholder="Seleccione Cargador Batería"
                onChange={seleccionarCargador}
              >
                {
                  listarEquiposCargadores && listarEquiposCargadores.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                defaultValue={nombreEquipo}
              ></Input>
              <Input
                placeholder="Ingrese Serie Cargador"
                style={{ width: 220 }}
                name='seriecargador_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.seriecargador_inve}
              ></Input>
              <Select
                style={{ width: 220 }}
                name="estadocargador_inve"
                onChange={seleccionarEstadoOperacionCargador}
                placeholder="Seleccione Estado Cargador"
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 660 }}
                name='observacioncargador_inve'
                onChange={handleChange}
                placeholder="Ingrese Observaciones del Cargador"
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>

      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Registrar Inventario Batería"
            >
              <Select
                placeholder="ID Bateria"
                style={{ width: 110 }}
                name="codigobateria_inve"
                placeholder="Seleccione Batería"
                onChange={seleccionarBateria}
              >
                {
                  listarEquiposBaterias && listarEquiposBaterias.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                defaultValue={nombreEquipo}
              ></Input>
              <Input
                placeholder="Ingrese Serie Batería"
                style={{ width: 220 }}
                name='seriebateria_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.seriebateria_inve}
              ></Input>
              <Select
                style={{ width: 220 }}
                name="estadobateria_inve"
                onChange={seleccionarEstadoOperacionBateria}
                placeholder="Seleccione Estado Batería"
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 660 }}
                name='observacionbateria_inve'
                onChange={handleChange}
                placeholder="Ingrese Observaciones del Cargador"
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>

    </div>
  )

  const consultarInventarioEquipo = (
    <div >
      <br />
      <MaterialTable
        columns={columnas}
        data={listComponenteInventario}
        title="Consultar Inventario Equipo"
        actions={[
          {
            icon: 'edit',
            tooltip: 'Editar Item',
            onClick: (event, rowData) => seleccionarInventarioEquipo(rowData, "Editar")
          },
          {
            icon: 'delete',
            tooltip: 'Eliminar Item',
            onClick: (event, rowData) => seleccionarInventarioEquipo(rowData, "Eliminar")
          },
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
        detailPanel={[
          {
            tooltip: 'Observaciones',
            render: rowData => {
              return (
                <div
                  style={{
                    fontSize: 14,
                    textAlign: 'center',
                    color: 'white',
                    backgroundColor: '#0277bd',
                  }}
                >
                  EQUIPO : {rowData.observacionequipo_inve} {"-"} 
                  CARGADOR : {rowData.observacioncargador_inve} {"-"} 
                  BATERÍA : {rowData.observacionbateria_inve}
                </div>
              )
            },
          },
        ]}

      />
    </div>
  )

  const inventarioEquipoEditar = (
    <div className="App" >
      <Title align="center" type="warning" level={4} >
        Modificar Inventario Equipo
      </Title>
      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Registrar Inventario Equipo"
            >
              <Input
                style={{ width: 110 }}
                name='codigoequipo_inve'
                onChange={handleChange}
                disabled="true"
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codigoequipo_inve}
              ></Input>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codigo_equ}
              ></Input>
              <Input
                placeholder="Ingrese Serie"
                style={{ width: 220 }}
                name='serieequipo_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.serieequipo_inve}
              ></Input>
              <Select
                placeholder="Seleccione Estado Equipo"
                style={{ width: 220 }}
                name="estadoequipo_inve"
                onChange={seleccionarEstadoOperacionEquipos}
                defaultValue={componenteInventarioSeleccionado && componenteInventarioSeleccionado.estadoequipo_inve}
                //value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.estadoequipo_inve}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                placeholder="Ingrese Observaciones del Equipo"
                style={{ width: 660 }}
                name='observacionequipo_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.observacionequipo_inve}
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>

      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Inventario Cargador Batería"
            >
              <Select
                placeholder="ID Cargador Bateria"
                style={{ width: 110 }}
                name="codigocargador_inve"
                placeholder="Seleccione Cargador Batería"
                disabled="true"
                onChange={seleccionarCargador}
                defaultValue={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codigocargador_inve}
              >
                {
                  listarEquiposCargadores && listarEquiposCargadores.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codcargador}
              ></Input>
              <Input
                placeholder="Ingrese Serie Cargador"
                style={{ width: 220 }}
                name='seriecargador_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.seriecargador_inve}
              ></Input>
              <Select
                style={{ width: 220 }}
                name="estadocargador_inve"
                onChange={seleccionarEstadoOperacionCargador}
                placeholder="Seleccione Estado Cargador"
                defaultValue={componenteInventarioSeleccionado && componenteInventarioSeleccionado.estadocargador_inve}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 660 }}
                name='observacioncargador_inve'
                onChange={handleChange}
                placeholder="Ingrese Observaciones del Cargador"
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.observacioncargador_inve}
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>

      <Form  >
        <Row justify="center" >
          <Col span={18} style={{ width: 1200 }}>
            <Item
              label="Registrar Inventario Batería"
            >
              <Select
                placeholder="ID Bateria"
                style={{ width: 110 }}
                name="codigobateria_inve"
                placeholder="Seleccione Batería"
                disabled="true"
                onChange={seleccionarBateria}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codigobateria_inve}
              >
                {
                  listarEquiposBaterias && listarEquiposBaterias.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 110 }}
                name='nombrecomponente'
                disabled="true"
                defaultValue={nombreEquipo}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.codbateria}
              ></Input>
              <Input
                placeholder="Ingrese Serie Batería"
                style={{ width: 220 }}
                name='seriebateria_inve'
                onChange={handleChange}
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.seriebateria_inve}
              ></Input>
              <Select
                style={{ width: 220 }}
                name="estadobateria_inve"
                onChange={seleccionarEstadoOperacionBateria}
                placeholder="Seleccione Estado Batería"
                defaultValue={componenteInventarioSeleccionado && componenteInventarioSeleccionado.estadobateria_inve}
              >
                {
                  listarEstados && listarEstados.map((itemselect) => {
                    return (
                      <Option value={itemselect.id_estcal}>{itemselect.nombre_estcal}</Option>
                    )
                  })
                }
              </Select>
              <Input
                style={{ width: 660 }}
                name='observacionbateria_inve'
                onChange={handleChange}
                placeholder="Ingrese Observaciones del Cargador"
                value={componenteInventarioSeleccionado && componenteInventarioSeleccionado.observacionbateria_inve}
              ></Input>
            </Item>
          </Col>
        </Row>
      </Form>
    </div>
  )

  const inventarioEquipoEliminar = (
    <div className="App">
      <p>Estás seguro que deseas eliminar el Componente del Inventario <b>{componenteInventarioSeleccionado &&
        componenteInventarioSeleccionado.elemento_inve}</b>? </p>
      <div align="right">
        <Button onClick={() => borrarInventarioEquipo()}> Confirmar </Button>
        <Button onClick={() => cerrarModalEliminarInventarioEquipo()}> Cancelar </Button>
      </div>
    </div>
  )

  const layoutequipo = {
    labelCol: {
      span: 12
    },
    wrapperCol: {
      span: 16
    }
  }


  const codigoEquipo = (
    <div className="App" >
      <div className="codigo-equipo">
        <Title align="center" type="warning" level={4} >
          SELECCIONAR EQUIPO
        </Title>
        <Form {...layoutequipo} >
          <Row justify="center" >
            <Col span={20}>
              <Item
                label="Codigo del Equipo"
              >
                <Select
                  style={{ width: 220 }}
                  name="equipo_inve"
                  placeholder="Seleccione el Equipo"
                  onChange={DatosEquipos}
                //onClick={(e) => DatosEquipos(e.target.value)}
                //onClick={(e) => DatosEquipos(e.target.value)}
                >
                  {
                    listarEquipos && listarEquipos.map((itemselect) => {
                      return (
                        <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                      )
                    })
                  }
                </Select>
              </Item>
            </Col>
          </Row>
          <br />
          <div align="center">
            <Button className="button1" onClick={() => abrirModalInsertarInventarioEquipo()}>  Grabar Inventario
            </Button>
          </div>
        </Form>

      </div>

    </div>
  )

  const codigoEquipoConsultar = (
    <div className="App" >
      <div className="codigo-equipo">
        <Title align="center" type="warning" level={4} >
          SELECCIONAR EQUIPO
        </Title>
        <Form {...layoutequipo} >
          <Row justify="center" >
            <Col span={20}>
              <Item
                label="Codigo del Equipo"
              >
                <Select
                  style={{ width: 220 }}
                  name="equipo_inve"
                  placeholder="Seleccione el Equipo"
                  onChange={DatosEquipos}
                //onClick={(e) => DatosEquipos(e.target.value)}
                //onClick={(e) => DatosEquipos(e.target.value)}
                >
                  {
                    listarEquipos && listarEquipos.map((itemselect) => {
                      return (
                        <Option value={itemselect.id_equ}>{itemselect.codigo_equ}</Option>
                      )
                    })
                  }
                </Select>
              </Item>
            </Col>
          </Row>
          <br />
          <div align="center">
            <Button className="button1" onClick={() => leerInventarioEquipo()}>  Consultar Inventario
            </Button>
          </div>
        </Form>

      </div>

    </div>
  )

  return (
    <div className="App">
      <br />
      <Row justify="center">
        <div>
          <Button className="button5" icon={<FileAddOutlined />} onClick={() => abrirModalEquipos()} >Grabar Inventario </Button>
          <Button className="button6" icon={<FileAddOutlined />} onClick={() => abrirModalEditarInventarioEquipo()} >Modificar Inventario</Button>
        </div>
      </Row>

      <Modal
        title="GRABAR INVENTARIO EQUIPO" visible={modalInsertarInventarioEquipo}
        onOk={cerrarModalInsertarInventarioEquipo}
        width={1200}
        closable={false}
        footer={[
          <Button type="primary" onClick={grabaInventarioEquipo} > Enviar </Button>,
          <Button type="primary" danger onClick={cerrarModalInsertarInventarioEquipo} > Cancelar </Button>
        ]}
      >
        {inventarioEquipoInsertar}
      </Modal>

      <Modal
        title="MODIFICAR DATOS DEL INVENTARIO" visible={modalEditarInventarioEquipo}
        onOk={cerrarModalEditarInventarioEquipo}
        width={1000}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalEditarInventarioEquipo} > Cancelar </Button>,
        ]}
      >
        {codigoEquipoConsultar}
      </Modal>

      <Modal
        title="ELIMINAR DATOS DEL INVENTARIO" visible={modalEliminarInventarioEquipo}
        onOk={cerrarModalEliminarInventarioEquipo}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalEliminarInventarioEquipo} > Cancelar </Button>,
        ]}
      >
        {inventarioEquipoEliminar}
      </Modal>

      <Modal
        title="REGISTRAR INVENTARIO" visible={modalEquipos}
        onOk={cerrarModalEquipos}
        width={600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalEquipos} > Cancelar </Button>,
          <Button type="primary"  > Enviar </Button>
        ]}
      >
        {codigoEquipo}
      </Modal>

      <Modal
        title="CONSULTAR INVENTARIO EQUIPO" visible={modalConsultarInventarioEquipo}
        onOk={cerrarModalConsultarInventarioEquipo}
        width={1600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalConsultarInventarioEquipo} > Cancelar </Button>
        ]}
      >
        {consultarInventarioEquipo}
      </Modal>

      <Modal
        title="CONSULTAR INVENTARIO EQUIPO" visible={modalModificarInventarioEquipo}
        onOk={cerrarModalModificarInventarioEquipo}
        width={1600}
        closable={false}
        footer={[
          <Button type="primary" danger onClick={cerrarModalModificarInventarioEquipo} > Cancelar </Button>,
          <Button type="primary" onClick={actualizarInventarioEquipo} > Enviar </Button>
        ]}
      >
        {inventarioEquipoEditar}
      </Modal>
    </div>
  );
}

export default InventarioEquipo;