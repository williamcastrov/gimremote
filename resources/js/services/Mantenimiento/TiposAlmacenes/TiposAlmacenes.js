import React, { useEffect, useState } from "react";
import axios from "axios";
import MaterialTable from "material-table";
import { Modal, TextField, Button, Select, MenuItem, FormControl, InputLabel, Typography } from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import SaveIcon from '@material-ui/icons/Save';
import swal from 'sweetalert';

// Componentes de Conexion con el Backend
import tiposalmacenesServices from "../../../services/Almacenes/TiposAlmacenes";
import estadosServices from "../../../services/Parameters/Estados";
import empresasServices from "../../../services/Empresa";

const useStyles = makeStyles((theme) => ({
  modal: {
    position: 'absolute',
    width: 400,
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
    minWidth: 315,
  },
  typography: {
    fontSize: 16,
    color: "#ff3d00"
  }
}));

function TiposAlmacenes() {
  const styles = useStyles();
  const [listTipoAlmacenes, setListTiposAlmacenes] = useState([]);
  const [modalInsertar, setModalInsertar] = useState(false);
  const [modalEditar, setModalEditar] = useState(false);
  const [modalEliminar, setModalEliminar] = useState(false);
  const [formError, setFormError] = useState(false);
  const [listarEmpresas, setListarEmpresas] = useState([]);
  const [listarEstados, setListarEstados] = useState([]);

  const [tiposAlmacenesSeleccionado, setTiposAlmacenesSeleccionado] = useState({
    id_talm: "",
    descripcion_talm: "",
    empresa_talm: "",
    estado_talm: "",
  })

  useEffect(() => {
    async function fetchDataTiposAlmacenes() {
      const res = await tiposalmacenesServices.listTiposalmacenes();
      setListTiposAlmacenes(res.data);
    }
    fetchDataTiposAlmacenes();
  }, [])

  useEffect(() => {
    async function fetchDataEmpresas() {
      const res = await empresasServices.listEmpresas();
      setListarEmpresas(res.data)
      console.log(res.data);
    }
    fetchDataEmpresas();
  }, [])

  useEffect(() => {
    async function fetchDataEstados() {
      const res = await estadosServices.listEstados();
      setListarEstados(res.data)
      console.log(res.data);
    }
    fetchDataEstados();
  }, [])

  const handleChange = e => {
    const { name, value } = e.target;

    setTiposAlmacenesSeleccionado(prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  const seleccionarTiposAlmacenes = (tipomtto, caso) => {
    setTiposAlmacenesSeleccionado(tipomtto);
    (caso === "Editar") ? abrirCerrarModalEditar() : abrirCerrarModalEliminar()
  }

  const abrirCerrarModalInsertar = () => {
    setModalInsertar(!modalInsertar);
  }

  const abrirCerrarModalEditar = () => {
    setModalEditar(!modalEditar);
  }

  const abrirCerrarModalEliminar = () => {
    setModalEliminar(!modalEliminar);
  }

  const grabarTipoAlmacen = async () => {

    setFormError({});
    let errors = {};
    let formOk = true;

    if (!tiposAlmacenesSeleccionado.descripcion_talm) {
      errors.descripcion_talm = true;
      formOk = false;
    }

    if (!tiposAlmacenesSeleccionado.empresa_talm) {
      errors.empresa_talm = true;
      formOk = false;
    }

    if (!tiposAlmacenesSeleccionado.estado_talm) {
      errors.estado_talm = true;
      formOk = false;
    }

    setFormError(errors);

    if (formOk) {
      console.log(tiposAlmacenesSeleccionado);
      const res = await tiposalmacenesServices.save(tiposAlmacenesSeleccionado);

      if (res.success) {
        swal("Tipo de Almacen", "Creado de forma Correcta!", "success", { button: "Aceptar" });
        console.log(res.message)
        abrirCerrarModalInsertar();
        delete tiposAlmacenesSeleccionado.descripcion_talm;
        delete tiposAlmacenesSeleccionado.empresa_talm;
        delete tiposAlmacenesSeleccionado.estado_talm;
      } else {
        swal("Tipo de Almacen", "Error Creando el Tipo de Almacen!", "error", { button: "Aceptar" });
        console.log(res.message);
        abrirCerrarModalInsertar();
      }
    }
    else {
      swal("Tipo de Almacen", "Debe Ingresar Todos los Datos, Revisar Información!", "warning", { button: "Aceptar" });
      console.log(res.message);
      abrirCerrarModalInsertar();
    }
  }

  const actualizarTipoAlmacen = async () => {

    setFormError({});
    let errors = {};
    let formOk = true;

    if (!tiposAlmacenesSeleccionado.descripcion_talm) {
      errors.descripcion_talm = true;
      formOk = false;
    }

    if (!tiposAlmacenesSeleccionado.empresa_talm) {
      errors.empresa_talm = true;
      formOk = false;
    }

    if (!tiposAlmacenesSeleccionado.estado_talm) {
      errors.estado_talm = true;
      formOk = false;
    }
    setFormError(errors);

    if (formOk) {

      const res = await tiposalmacenesServices.update(tiposAlmacenesSeleccionado);

      if (res.success) {
        swal("Tipo de Almacen", "Actualizado de forma Correcta!", "success", { button: "Aceptar" });
        console.log(res.message)
        abrirCerrarModalEditar();
        delete tiposAlmacenesSeleccionado.descripcion_talm;
        delete tiposAlmacenesSeleccionado.empresa_talm;
        delete tiposAlmacenesSeleccionado.estado_talm;
      } else {
        swal("Tipo de Almacen", "Error Actualizando el tipo de Almacen!", "error", { button: "Aceptar" });
        console.log(res.message);
        abrirCerrarModalEditar();
      }
    }
    else {
      swal("Tipo de Almacen", "Debe Ingresar Todos los Datos, Revisar Información!", "warning", { button: "Aceptar" });
      console.log(res.message);
      abrirCerrarModalEditar();
    }
  }

  const borrarTipomtto = async () => {

    const res = await tiposalmacenesServices.delete(tiposAlmacenesSeleccionado.id_talm);

    if (res.success) {
      swal("Tipo de Almacen", "Borrado de forma Correcta!", "success", { button: "Aceptar" });
      console.log(res.message)
      abrirCerrarModalEliminar();
    }
    else {
      swal("Tipo de Almacen", "Error Borrando el Tipo de Almacen!", "error", { button: "Aceptar" });
      console.log(res.message);
      abrirCerrarModalEliminar();
    }

  }
  // "string","boolean","numeric","date","datetime","time","currency"
  const columnas = [
    {
      title: 'Id',
      field: 'id_talm'
    },
    {
      title: 'Descripcion',
      field: 'descripcion_talm'
    },
    {
      title: 'Código',
      field: 'empresa_talm'
    },
    {
      title: 'Nombre Empresa',
      field: 'nombre_emp'
    },
    {
      title: 'Codigo',
      field: 'estado_talm'
    },
    {
      title: 'Estado',
      field: 'nombre_est'
    }
  ]

  const tipoAlmacenInsertar = (
    <div className={styles.modal}>
      <Typography align="center" className={styles.typography} variant="button" display="block">Agregar Tipo de Almacen</Typography>
      <TextField className={styles.inputMaterial} label="Descripcion" name="descripcion_talm" onChange={handleChange} />
      <br />
      <FormControl className={styles.formControl}>
        <InputLabel id="idselectEmpresa">Empresa</InputLabel>
        <Select
          labelId="selectEmpresa"
          name="empresa_talm"
          id="idselectEmpresa"
          onChange={handleChange}
        >
          <MenuItem value="">  <em>None</em> </MenuItem>
          {
            listarEmpresas.map((itemselect) => {
              return (
                <MenuItem value={itemselect.id_emp}>{itemselect.nombre_emp}</MenuItem>
              )
            })
          }
        </Select>
      </FormControl>
      <br />
      <FormControl className={styles.formControl}>
        <InputLabel id="idselectEstado">Estado</InputLabel>
        <Select
          labelId="selectEstado"
          name="estado_talm"
          id="idselectEstado"
          onChange={handleChange}
        >
          <MenuItem value=""> <em>None</em> </MenuItem>
          {
            listarEstados.map((itemselect) => {
              return (
                <MenuItem value={itemselect.id_est}>{itemselect.nombre_est}</MenuItem>
              )
            })
          }
        </Select>
      </FormControl>
      <div align="right">
        <Button color="primary" onClick={() => grabarTipoAlmacen()} >Insertar</Button>
        <Button onClick={() => abrirCerrarModalInsertar()} >Cancelar</Button>
      </div>
    </div>
  )

  const tipoAlmacenEditar = (
    <div className={styles.modal}>
       <Typography align="center" className={styles.typography} variant="button" display="block">Actualizar Tipo de Almacen</Typography>
      <TextField className={styles.inputMaterial} label="Descripcion" name="descripcion_talm" onChange={handleChange} value={tiposAlmacenesSeleccionado && tiposAlmacenesSeleccionado.descripcion_talm} />
      <br />
      <FormControl className={styles.formControl}>
        <InputLabel id="idselectEmpresa">Empresa</InputLabel>
        <Select
          labelId="selectEmpresa"
          name="empresa_talm"
          id="idselectEmpresa"
          onChange={handleChange}
          value={tiposAlmacenesSeleccionado && tiposAlmacenesSeleccionado.empresa_talm}
        >
          <MenuItem value="">  <em>None</em> </MenuItem>
          {
            listarEmpresas.map((itemselect) => {
              return (
                <MenuItem value={itemselect.id_emp}>{itemselect.nombre_emp}</MenuItem>
              )
            })
          }
        </Select>
      </FormControl>
      <FormControl className={styles.formControl}>
        <InputLabel id="idselectEstado">Estado</InputLabel>
        <Select
          labelId="selectEstado"
          name="estado_talm"
          id="idselectEstado"
          onChange={handleChange}
          value={tiposAlmacenesSeleccionado && tiposAlmacenesSeleccionado.estado_talm}
        >
          <MenuItem value=""> <em>None</em> </MenuItem>
          {
            listarEstados.map((itemselect) => {
              return (
                <MenuItem value={itemselect.id_est}>{itemselect.nombre_est}</MenuItem>
              )
            })
          }
        </Select>
      </FormControl>
      <br />
      <div align="right">
        <Button color="primary" onClick={() => actualizarTipoAlmacen()} >Editar</Button>
        <Button onClick={() => abrirCerrarModalEditar()}>Cancelar</Button>
      </div>
    </div>
  )

  const tipoAlmacenEliminar = (
    <div className={styles.modal}>
      <p>Estás seguro que deseas eliminar el Tipo de Almacen <b>{tiposAlmacenesSeleccionado && tiposAlmacenesSeleccionado.nombre_talm}</b>? </p>
      <div align="right">
        <Button color="secondary" onClick={() => borrarTipoAlmacen()}> Confirmar </Button>
        <Button onClick={() => abrirCerrarModalEliminar()}> Cancelar </Button>
      </div>
    </div>
  )

  return (
    <div className="App">
      <br />
      <Button variant="contained" startIcon={<SaveIcon />} color="primary" onClick={() => abrirCerrarModalInsertar()} >Agregar Tipo de Almacen</Button>
      <MaterialTable
        columns={columnas}
        data={listTipoAlmacenes}
        title="TIPOS DE ALMACENES"
        actions={[
          {
            icon: 'edit',
            tooltip: 'Editar Tipo de Almacen',
            onClick: (event, rowData) => seleccionarTiposAlmacenes(rowData, "Editar")
          },
          {
            icon: 'delete',
            tooltip: 'Borrar Tipo de Almacen',
            onClick: (event, rowData) => seleccionarTiposAlmacenes(rowData, "Eliminar")
          }
        ]}
        options={{
          actionsColumnIndex: -1
        }}
        localization={{
          header: {
            actions: "Acciones"
          }
        }}
      />{ }
      <Modal
        open={modalInsertar}
        onClose={abrirCerrarModalInsertar}
      >
        {tipoAlmacenInsertar}
      </Modal>

      <Modal
        open={modalEditar}
        onClose={abrirCerrarModalEditar}
      >
        {tipoAlmacenEditar}
      </Modal>

      <Modal
        open={modalEliminar}
        onClose={abrirCerrarModalEliminar}
      >
        {tipoAlmacenEliminar}
      </Modal>
    </div>
  );
}

export default TiposAlmacenes;