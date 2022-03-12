import { render } from "react-dom";
import { Banner, Wrapper } from "../lib";

function App() {
  return (
    <div className="theme-root theme-root--white">
      <Wrapper>
        <Banner />
        <Banner speed={5} />
      </Wrapper>
    </div>
  );
}

render(<App />, document.getElementById("react-root"));
