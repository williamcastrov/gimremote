import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import {Modal, TextField, Button, Select, MenuItem, FormControl, InputLabel, Typography, Grid } from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";
import SaveIcon from '@material-ui/icons/Save';
import swal from 'sweetalert';

// Componentes de Conexion con el Backend
import nombrecargootServices from "../../../services/Mantenimiento/NombreCargoOT";
import ordenesServices from "../../../services/GestionOrdenes/CrearOrdenes";

const useStyles = makeStyles((theme) => ({
  modal: {
    position: 'absolute',
    width: 500,
    backgroundColor: theme.palette.background.paper,
    border: '2px solid #000',
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2, 4, 3),
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)'
  },
  iconos:{
    cursor: 'pointer'
  }, 
  inputMaterial:{
    width: '100%'
  },
  formControl: {
    margin: theme.spacing(0),
    minWidth: 200,
  },
  typography: {
    fontSize: 16,
    color   : "#ff3d00"
  }
}));

function NombreCargoOT(props) {
  const { id_otr } = props;
  const styles = useStyles();
  const [listNombreCargoOT, setListNombreCargoOT] = useState([]);
  const [modalInsertar, setModalInsertar ] = useState(false);
  const [modalEditar, setModalEditar]= useState(false);
  const [modalEliminar, setModalEliminar]= useState(false);
  const [formError, setFormError] = useState(false);
  const [listarOrdenes, setListarOrdenes] = useState([]);
  const [listarEstados, setListarEstados] = useState([]);
  const [grabar, setGrabar] = useState(false);
  const [nombreCargoOTSeleccionado, setNombreCargoOTSeleccionado] = useState({
    id_ncot: "",
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
    const {name, value} = e.target;

    setListNombreCargo( prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  const seleccionarNombreCargo = (pendiente, caso)=>{
    setNombreCargoOT(pendiente);
    (caso==="Editar") ? abrirCerrarModalEditar() : abrirCerrarModalEliminar()
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

  const grabaNombreCargo = async () => {
  
    setFormError({});
    let errors = {};
    let formOk = true;

    if (!nombreCargoOT.nombrerecibe_ncot) {
      alert("1")
      errors.nombrerecibe_ncot = true;
      formOk = false;
    }

    if (!nombreCargoOT.cargorecibe_ncot) {
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
        setNombreCargoOT([{
          id_ncot: 0,
          ot_ncot: id_otr,
          nombrerecibe_ncot: nombreCargoOT.nombrerecibe_ncot,
          cargorecibe_ncot: nombreCargoOT.cargorecibe_ncot
        }]);
      }
      setGrabar(true); 
  }

  useEffect(() => {
    async function grabarNombreCargo() {

      if (grabar) {
        console.log("NOMBRE CARGO : ", nombreCargoOT)

        const res = await nombrecargootServices.save(nombreCargoOT[0]);

        if (res.success) {

          swal("Nombre y Cargo", "Nombre y Cargo Creado de forma Correcta!", "success", { button: "Aceptar" });

          console.log(res.message)
        } else {
          swal("Nombre y Cargo", "Error Creando Nombre y Cargo!", "error", { button: "Aceptar" });
          console.log(res.message);
        }
        setGrabar(false);
      }
    }
    grabarNombreCargo();
  }, [grabar])

  const borrarNombreCargo = async()=>{
   
    const res = await nombrecargootServices.delete(nombreCargoOT.id);

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

  const nombreCargoInsertar = (
    <div className={styles.modal}>
      <Typography  align="center" className={ styles.typography } variant="button" display="block" >
        Actualizar Nombre y Cargo
      </Typography>
      <Grid container spacing={2} >
        <Grid item xs={12} md={12}>
          <TextField name="repuesto_pot" label="Código Repuesto" fullWidth onChange={handleChange} 
           value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.repuesto_pot}/>
        </Grid>
        <Grid item xs={12} md={12}>
          <TextField name="descripcion_pot" label="Descripción del pendiente" fullWidth onChange={handleChange} 
          value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.descripcion_pot}/>
        </Grid>
      </Grid>
      <br />
      <br />
      <div align="right">
        <Button color="primary"  onClick={()=>grabaNombreCargo()} >Editar</Button>
        <Button onClick={()=>abrirCerrarModalEditar()}>Cancelar</Button>
      </div>
    </div>
  )

  const nombreCargoEditar = (
    <div className={styles.modal}>
      <Typography  align="center" className={ styles.typography } variant="button" display="block" >
        Actualizar Nombre y Cargo
      </Typography>
      <Grid container spacing={2} >
        <Grid item xs={12} md={12}>
          <TextField name="repuesto_pot" label="Código Repuesto" fullWidth onChange={handleChange} 
           value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.repuesto_pot}/>
        </Grid>
        <Grid item xs={12} md={12}>
          <TextField name="descripcion_pot" label="Descripción del pendiente" fullWidth onChange={handleChange} 
          value={nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.descripcion_pot}/>
        </Grid>
      </Grid>
      <br />
      <br />
      <div align="right">
        <Button color="primary"  onClick={()=>actualizarPendiente()} >Editar</Button>
        <Button onClick={()=>abrirCerrarModalEditar()}>Cancelar</Button>
      </div>
    </div>
  )

  const unidadEliminar = (
    <div className={styles.modal}>
      <p>Estás seguro que deseas eliminar la Unidad de Control <b>{nombreCargoOTSeleccionado && nombreCargoOTSeleccionado.descripcion_pot}</b>? </p>
      <div align="right">
        <Button color="secondary" onClick = {() => borrarUnidad() }> Confirmar </Button>
        <Button onClick={()=>abrirCerrarModalEliminar()}> Cancelar </Button>
      </div>
    </div>
  )

  return (
    <div className="App">
    <br />
    <MaterialTable
       columns={columnas}
       data={listNombreCargoOT}
       title="NOMBRE Y CARGO FUNCIONARIO"
       actions={[
         {
           icon     : 'edit',
           tooltip  : 'Editar Nombre y Cargo',
           onClick  : (event, rowData) => seleccionarNombreCargo(rowData, "Editar")
         },
         {
          icon     : 'delete',
          tooltip  : 'Borrar Nombre y Cargo',
          onClick  : (event, rowData) => seleccionarNombreCargo(rowData, "Eliminar")
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
    />{}

    <Modal
      open={modalEditar}
      onClose={abrirCerrarModalEditar}
    >
      {nombreCargoEditar}
    </Modal>

    <Modal
      open={modalEliminar}
      onClose={abrirCerrarModalEliminar}
    >
      {unidadEliminar}
    </Modal>
    </div>
  );
}

export default NombreCargoOT;