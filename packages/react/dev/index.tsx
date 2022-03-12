import { render } from "react-dom";
import { Banner } from "../lib";

function App() {
  return (
    <div className="theme-root theme-root--white">
      <Banner />
      <Banner speed={5} />
    </div>
  );
}

render(<App />, document.getElementById("react-root"));
