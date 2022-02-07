import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import {Modal, TextField, Button, Select, MenuItem, FormControl, InputLabel, Typography } from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";
import SaveIcon from '@material-ui/icons/Save';
import swal from 'sweetalert';

import datoshorometroServices from "../../../services/Mantenimiento/DatosHorometro";
import equiposServices from "../../../services/Mantenimiento/Equipos";

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
  iconos:{
    cursor: 'pointer'
  }, 
  inputMaterial:{
    width: '100%'
  },
  typography: {
    fontSize: 16,
    color   : "#ff3d00"
  }
}));

function DatosHorometro() {
  const styles = useStyles();
  const [listDatosHorometro, setListDatosHorometro] = useState([]);
  const [validar, setValidar] = useState([]);
  const [modalInsertar, setModalInsertar ] = useState(false);
  const [modalEditar, setModalEditar]= useState(false);
  const [modalEliminar, setModalEliminar]= useState(false);
  const [formError, setFormError] = useState(false);
  const [listarEquipos, setListarEquipos] = useState([]);
  const [datosHorometroSeleccionado, setDatosHorometroSeleccionado] = useState({
    id_dhr: "",
    codigoequipo_dhr: "",
    valorhorometro_dhr: ""
  })

  useEffect(() => {
    async function fetchDataHorometro() {
      const res = await datoshorometroServices.listdatoshorometro();
      setListDatosHorometro(res.data);
      setValidar(res.data);
    }
    fetchDataHorometro();
  }, [])

  useEffect(() => {
    async function fetchDataEquipos() {
      const res = await equiposServices.listEquipos();
      setListarEquipos(res.data);
    }
    fetchDataEquipos();
  }, [])

  const handleChange = e => {
    const {name, value} = e.target;

    setDatosHorometroSeleccionado( prevState => ({
      ...prevState,
      [name]: value
    }));
  }

  const seleccionarHorometro=(datoshorometro, caso)=>{
    setDatosHorometroSeleccionado(datoshorometro);
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

  

  const grabarHorometro = async () => {

    setFormError({});
    let errors = {};
    let formOk = true;

    if (!datoshorometroSeleccionado.codigoequipo_dhr) {
      errors.codigoequipo_dhr = true;
      formOk = false;
    }

    if (!datoshorometroSeleccionado.valorhorometro_dhr) {
      errors.valorhorometro_dhr = true;
      formOk = false;
    }

    setFormError(errors);

    if (formOk) {
      const res = await datoshorometroServices.save(datoshorometroSeleccionado);

      if (res.success) {
        swal({
          title: "Datos Horometro",
          text: "Control Horometro Creado de forma Correcta!",
          icon: "success",
          button: "Aceptar"
        });
        console.log(res.message)
        abrirCerrarModalInsertar();
        delete datoshorometroSeleccionado.codigoequipo_dhr;
        delete datoshorometroSeleccionado.valorhorometro_dhr;
      } else
      {
        swal({
          title : "Datos Horometro",
          text  : "Error Creando el Control Horometro!",
          icon  : "error",
          button: "Aceptar"
        });
        console.log(res.message);
        abrirCerrarModalInsertar();
      }
    }
    else {
      swal({
        title : "Datos Horometro",
        text  : "Debe ingresar todos los datos, Error creando el Control Horometro!",
        icon  : "warning",
        button: "Aceptar"
      });
      console.log(res.message);
      abrirCerrarModalInsertar();
    }
  }

  const actualizarHorometro = async () => {
  
    setFormError({});
    let errors = {};
    let formOk = true;

    if (!datoshorometroSeleccionado.codigo_pai) {
      errors.codigo_pai = true;
      formOk = false;
    }

    if (!datoshorometroSeleccionado.nombre_pai) {
      errors.nombre_pai = true;
      formOk = false;
    }

    setFormError(errors);

    if (formOk) {
    
    const res = await datoshorometroServices.update(datoshorometroSeleccionado);
    console.log(datoshorometroSeleccionado);

    if (res.success) {
        swal({
          title: "Datos Horometro",
          text: "Control Horometro Actualizado de forma Correcta!",
          icon: "success",
          button: "Aceptar"
        });
        console.log(res.message)
        abrirCerrarModalEditar();
        delete datoshorometroSeleccionado.codigoequipo_dhr;
        delete datoshorometroSeleccionado.valorhorometro_dhr;
    } else
    {
        alert("");
        swal({
          title : "Datos Horometro",
          text  : "Error Actualizando el Control Horometro!",
          icon  : "error",
          button: "Aceptar"
        });
        console.log(res.message);
        abrirCerrarModalEditar();
    }
    }
    else {
    c
      console.log(res.message);
      abrirCerrarModalEditar();
    } 
  }

  const borrarHorometro = async()=>{
   
    const res = await datoshorometroServices.delete(datoshorometroSeleccionado.id_pai);

    if (res.success) {
        swal({
          title : "Datos Horometro",
          text  : "Control Horometro Borrada de forma Correcta!",
          icon  : "success",
          button: "Aceptar"
        });
        console.log(res.message)
        abrirCerrarModalEliminar();
    }
    else {
        swal({
          title : "Datos Horometro",
          text  : "Error brorrando el Control Horometro!",
          icon  : "error",
          button: "Aceptar"
        });
        console.log(res.message);
        abrirCerrarModalEliminar();
    }
  }

  const columnas = [
    {
      title: 'Id',
      field: 'id_dhr',
      type: 'number'
    },
    {
      title: 'Codigo',
      field: 'codigo_equ'
    },
    {
        title: 'Descripción',
        field: 'descripcion_equ'
      },
    {
      title: 'Valor Horometro',
      field: 'valorhorometro_dhr'
    }
  ]

  const horometroInsertar=(
    <div className={styles.modal}>
      <Typography  align="center" className={ styles.typography } variant="button" display="block" >
        Agregar Control Horometro
      </Typography>
      <TextField className={styles.inputMaterial} label="Código" name="codigoequipo_dhr" onChange={handleChange} />
      <FormControl className={styles.formControl}>
        <InputLabel id="idscodigoequipo_dhr">Equipo</InputLabel>
        <Select
          labelId="selectcodigoequipo_dhr"
          name="codigoequipo_dhr"
          id="idcodigoequipo_dhr"
          onChange={handleChange}
        >
          <MenuItem value="">  <em>None</em> </MenuItem>
          {
            listarEquipos.map((itemselect) => {
              return (
                <MenuItem value={itemselect.id_equ }>{itemselect.descripcion_equ}</MenuItem>
              )
            })
          }
        </Select>
      </FormControl>
      <br />
      <div align="right">    
        <Button color="primary" onClick = { () => grabarHorometro() } >Insertar</Button>
        <Button onClick={()=> abrirCerrarModalInsertar()} >Cancelar</Button>
      </div>
    </div>
  )

  const horometroEditar =(
    <div className={styles.modal}>
      <Typography  align="center" className={ styles.typography } variant="button" display="block" >
        Actualizar Datos Paises
      </Typography>
      <TextField className={styles.inputMaterial} label="Código" name="codigo_pai" onChange={handleChange} value={datoshorometroSeleccionado&&datoshorometroSeleccionado.codigo_pai}/>
      <br />
      <TextField className={styles.inputMaterial} label="País" name="nombre_pai" onChange={handleChange} value={datoshorometroSeleccionado&&datoshorometroSeleccionado.nombre_pai}/>          
      <br /><br />
      <div align="right">
        <Button color="primary"  onClick={()=>actualizarPais()} >Editar</Button>
        <Button onClick={()=>abrirCerrarModalEditar()}>Cancelar</Button>
      </div>
    </div>
  )

  const horometroEliminar = (
    <div className={styles.modal}>
      <p>Estás seguro que deseas eliminar el País <b>{datoshorometroSeleccionado && datoshorometroSeleccionado.nombre_pai}</b>? </p>
      <div align="right">
        <Button color="secondary" onClick = {() => borrarPais() }> Confirmar </Button>
        <Button onClick={()=>abrirCerrarModalEliminar()}> Cancelar </Button>

      </div>

    </div>
  )

  return (
    <div className="App">
    <br />
    <Button variant="contained" startIcon={<SaveIcon />} color="primary" onClick={()=> abrirCerrarModalInsertar() } >Insertar Pais</Button>
     <MaterialTable
       columns={columnas}
       data={listPaises}
       title="CONTROL VALOR HOROMETRO"
       actions={[
         {
           icon     : 'edit',
           tooltip  : 'Editar Horometro',
           onClick  : (event, rowData) => seleccionarHorometro(rowData, "Editar")
         },
         {
          icon     : 'delete',
          tooltip  : 'Borrar Horometro',
          onClick  : (event, rowData) => seleccionarHorometro(rowData, "Eliminar")
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
      open={modalInsertar}
      onClose={abrirCerrarModalInsertar}
    >
      {horometroInsertar}
    </Modal>

    <Modal
      open={modalEditar}
      onClose={abrirCerrarModalEditar}
    >
      {horometroEditar}
    </Modal>

    <Modal
      open={modalEliminar}
      onClose={abrirCerrarModalEliminar}
    >
      {horometroEliminar}
    </Modal>
    </div>
  );
}

export default DatosHorometro;