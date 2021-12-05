import url from "../../components/Url";
const baseUrl = `${url}/api/equipos`;
import axios from "axios";
const equipos = {};

equipos.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

equipos.listEquipos = async () => {
    const urlList = baseUrl+"/listar_equipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listReporteEquipos = async () => {
    const urlList = baseUrl+"/listar_reporteequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listbajasequiposhistoricos = async () => {
    const urlList = baseUrl+"/listar_bajasequiposhistoricos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listEquiposMontacargas = async () => {
    const urlList = baseUrl+"/listar_equiposmontacargas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listEquiposMontacargasusuario = async () => {
    const urlList = baseUrl+"/listar_equiposmontacargasusuario"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}


equipos.listaralertasestadosequipos = async (totequipos) => {
    const urlList = baseUrl+"/listar_alertasestadosequipos/"+totequipos
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.sumatotalequipos = async () => {
    const urlList = baseUrl+"/sumatotalequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
       
    return res;
}

equipos.detalleequipos = async () => {
    const urlList = baseUrl+"/detalleequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
       
    return res;
}
    
equipos.listEquiposAccesoriosCargadores = async () => {
    const urlList = baseUrl+"/listar_equiposaccesorioscargadores"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listEquiposAccesoriosBaterias = async () => {
    const urlList = baseUrl+"/listar_equiposaccesoriosbaterias"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listEquiposAccesorios = async () => {
    const urlList = baseUrl+"/listar_equiposaccesorios"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listActivosRenta = async () => {
    const urlList = baseUrl+"/listar_activosrenta"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listActivosAsegurados = async () => {
    const urlList = baseUrl+"/listar_activosasegurados"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.listUnEquipo = async (id_equ) => {
    const urlList = baseUrl+"/get/"+id_equ
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.leecombos = async (id_equ) => {
    const urlList = baseUrl+"/leecombos/"+id_equ
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.update = async (data) => {
    //console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_equ
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

equipos.delete = async (id_equ) => {
    const urlDelete = baseUrl+"/delete/"+id_equ
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default equipos;