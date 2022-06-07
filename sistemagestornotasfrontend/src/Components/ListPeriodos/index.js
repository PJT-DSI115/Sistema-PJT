
import { Link, Outlet } from 'react-router-dom'
import './index.css'
function ListPeriodos() {

    return (
        <div>
            <div className= "main__periodo">
                <h3 className= "periodo__title">Periodos</h3>
                <Link to = '1' className="periodo__link">P-2022</Link> 
            </div>
            <Outlet/>
        </div>
    );
}

export {
    ListPeriodos
}