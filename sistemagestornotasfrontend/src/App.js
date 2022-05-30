import './App.css';
import { Route, Routes } from 'react-router-dom';
import { Login } from "Components/Login"
import { UserContextProvider } from "Context/UserContext";
import { Home } from 'Pages/Home';
import { Error403 } from 'Pages/Error403';
import { Periodo } from 'Components/Periodo';
import { CursoCard } from 'Components/CursoCard/CursoCard';

import { AssignTeacher } from 'Components/assignTeacher';

function App() {
	return (
		<UserContextProvider>
			<div className='App'>
				<Routes>
					<Route path = "/Login" element = {<Login />} />
					<Route path= '/' element = {<Home/>} />
					<Route path='/error403' element = {<Error403/>}  />
					<Route path='/periodo' element = {<Periodo />} />
					<Route path='/card' element = {<CursoCard />} />
                    <Route path = '/asignarProfesor'  >
                        <Route path = ":periodo" >
                            <Route path = ":nivelCurso" element = { <AssignTeacher /> } />
                        </Route>
                    </Route>
				</Routes>
			</div>
		</UserContextProvider>
	);
}

export default App;
