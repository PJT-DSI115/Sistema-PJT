import "./App.css";
import { Route, Routes } from "react-router-dom";
import { Login } from "Components/Login";
import { UserContextProvider } from "Context/UserContext";
import { Home } from "Pages/Home";
import { Error403 } from "Pages/Error403";
import { Periodo } from "Components/Periodo";
import { CursosNivel } from "Components/CursoCard";
import { Footer } from "Components/Footer";
import { Actividad } from "Components/Actividad";
import { AssignTeacher } from "Components/assignTeacher";
import { Sidebar } from "Components/SideBar";
import { ListadocursoDocente } from "Components/ListadoCursosDocente";
import { Curso } from 'Components/Curso';

function App() {
	return (
		<UserContextProvider>
			<div className="App">
				<div className="App-left">
					<div className="App-container">
						<Routes>
							<Route path="/Login" element={<Login />} />
							<Route path="/" element={<Home />} />
							<Route path="/error403" element={<Error403 />} />
							<Route path="/gestionPeriodo" element={<Periodo />} />
							<Route path="/asignarProfesor">
								<Route path=":idPeriodo">
									<Route path=":idCursoNivel" element={<AssignTeacher />} />
								</Route>
							</Route>
							<Route path="/listadoCursosDocente">
							<Route
								path=":idPeriodo"
								element={<ListadocursoDocente />}
							></Route>
							</Route>
							<Route path="/card" element={<CursosNivel />} />
							<Route path="/actividad">
							<Route path=":idPeriodo">
								<Route path=":idCursoNivel" element={<Actividad />} />
							</Route>
							</Route>
							<Route path = "/gestionCursos" element = { <Curso />} />
						</Routes>
					</div>
					<Footer />
				</div>
				<div className="App-right">
					<Sidebar />
				</div>
			</div>
		</UserContextProvider>
	);
}

export default App;
