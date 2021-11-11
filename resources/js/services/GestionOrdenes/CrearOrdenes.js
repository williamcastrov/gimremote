import url from "../../components/Url";
const baseUrl = `${url}/api/ordenesserv`;
import axios from "axios";
const crearordenes = {};

crearordenes.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

crearordenes.listOrdenesServActivas = async () => {    
    const urlList = baseUrl+"/listar_ordenesservactivas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.totalotactivas = async () => {    
    const urlList = baseUrl+"/totalotactivas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.totalotprogramadas = async () => {    
    const urlList = baseUrl+"/totalotprogramadas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.totalotrevision = async () => {    
    const urlList = baseUrl+"/totalotrevision"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.totalotmes = async () => {    
    const urlList = baseUrl+"/totalotmes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.totalotterminadasmes = async () => {    
    const urlList = baseUrl+"/totalotterminadasmes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.cumplimientototalotmes = async (periodo) => {    
    const urlList = baseUrl+"/cumplimientotalotmes/"+periodo
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.cumplimientootterminadasmes = async (periodo) => {    
    const urlList = baseUrl+"/cumplimientootterminadasmes/"+periodo
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServActivas = async () => {    
    const urlList = baseUrl+"/listar_ordenesservactivas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServActivasUsuario = async () => {    
    const urlList = baseUrl+"/listar_ordenesservactivasusuario"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServActivasRevision = async () => {    
    const urlList = baseUrl+"/listar_ordenesservactivasrevision"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServActivasRevisionUsuario = async () => {    
    const urlList = baseUrl+"/listar_ordenesservactivasrevisionusuario"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServ = async () => {    
    const urlList = baseUrl+"/listar_ordenesserv"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesServUsuario = async () => {    
    const urlList = baseUrl+"/listar_ordenesservusuario"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesChequeo = async () => {    
    const urlList = baseUrl+"/listar_ordeneschequeo"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listOrdenesChequeoActivas = async () => {    
    const urlList = baseUrl+"/listar_ordeneschequeoactivas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.listUnaOrden = async (id_otr) => {
    //console.log("DATA UNA ORDEN : ",id_otr)
    const urlList = baseUrl+"/get/"+id_otr
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.leeordentecnico = async (operario_otr) => {
    //console.log("DATA UNA ORDEN : ",id_otr)
    const urlList = baseUrl+"/leeordentecnico/"+operario_otr
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.leetodasordentecnico = async (operario_otr) => {
    //console.log("DATA UNA ORDEN : ",id_otr)
    const urlList = baseUrl+"/leetodasordentecnico/"+operario_otr
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.generarpdfotcliente = async (orden) => {
    console.log("DATA UNA ORDEN : ",orden)
    const urlList = baseUrl+"/generarPdf/"+orden
    const res = await axios.get(urlList)    
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.update = async (data) => {
    //console.log(data);
    //console.log("DATA : ", data.id_otr);
    const urlUpdate = baseUrl+"/update/"+data.id_otr
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.updateestadoasignado = async (data) => {
    //console.log("DATA : ", data.id_otr);
    const urlUpdate = baseUrl+"/updateestadoasignado/"+data.id_otr
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.actualizafinaltransporte = async (id_otr) => {
    //console.log("DATA : ", data.id_otr);
    const urlUpdate = baseUrl+"/actualizafinaltransporte/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.actualizainiciatransporte = async (id_otr) => {
    //console.log("DATA : ", data.id_otr);
    const urlUpdate = baseUrl+"/actualizainiciatransporte/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.actualizatiempoparoot = async (id_otr) => {
    //console.log("DATA : ", data.id_otr);
    const urlUpdate = baseUrl+"/actualizatiempoparoot/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.cancelar = async (id_otr) => {
    //console.log("DATA : ", id_otr);
    const urlUpdate = baseUrl+"/cancelar/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.ordenprogramada = async (id_otr) => {
    //console.log("DATA PROGRAMADA : ", id_otr);
    const urlUpdate = baseUrl+"/ordenprogramada/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.pasararevision = async (id_otr) => {
    //console.log("DATA PROGRAMADA : ", id_otr);
    const urlUpdate = baseUrl+"/pasararevision/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.sumartiempoactividades = async (id_otr) => {
    //console.log("DATA PROGRAMADA : ", id_otr);
    const urlUpdate = baseUrl+"/sumartiempoactividades/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.cerrarot = async (id_otr) => {
    //console.log("DATA PROGRAMADA : ", id_otr);
    const urlUpdate = baseUrl+"/cerrarOT/"+id_otr
    const res = await axios.put(urlUpdate)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

crearordenes.delete = async (id_otr) => {
    const urlDelete = baseUrl+"/delete/"+id_otr
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default crearordenes;