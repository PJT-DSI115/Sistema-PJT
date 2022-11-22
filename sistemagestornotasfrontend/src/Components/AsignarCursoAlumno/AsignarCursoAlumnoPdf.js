import uesLogo from 'assets/image/uesLogo.png';
import pjtLogo from 'assets/image/pjtLogo.png';
const AsignarCursoAlumnoPdf = ({ asignarCursoAlumno }, ref) => {
    const fecha = new Date();
    const mes = fecha.toLocaleString('default', { month: 'long' });

    return (
        <div className="bg-white p-8" ref={ref}>
            <div className="grid grid-cols-3 items-center text-center p-2">
                <img className="w-1/2 m-auto" src = {uesLogo} alt = "uesLogo" />
                <div className="text-2xl font-semibold">
                    <h2>Universidad de El Salvador</h2>
                    <h2>Programa Jovenes Talento</h2>
                </div>
                <img className="w-1/2 m-auto" src = {pjtLogo} alt = "pjtLogo" />
            </div>
        </div>
    );
};
export {AsignarCursoAlumnoPdf};