import { ReactNode, useState } from "react";
import { Box } from "./Box";
import * as Inputs from "./Inputs";
import { useThemeSettings } from "./ThemeContext";
import { GearIcon, CloseIcon } from "./Icons";
import { ButtonGroup } from "./ButtonGroup";

export function MenuForm() {
  const settingsManager = useThemeSettings();
  return (
    <>
      <Inputs.Slider
        onUpdate={(value) => settingsManager.setSiteWidth(value)}
        min="1"
        max="2000"
        defaultValue="1100"
        step="1"
        label="Site Width"
      />
    </>
  );
}

interface Props {
  children: ReactNode;
}

export function Menu({ children }: Props) {
  const [isOpen, setIsOpen] = useState(false);
  const menuClasses = ["Menu", isOpen ? "Menu--open" : "Menu--close"].join(" ");

  const handleClickOpen = () => {
    setIsOpen(true);
  };

  const handleClickClose = () => {
    setIsOpen(false);
  };

  return (
    <div className={menuClasses}>
      <button onClick={handleClickOpen} className="Menu-open">
        <GearIcon />
      </button>
      <Box
        className="Menu-contents"
        header={
          <Box.Header
            actionButtons={
              <>
                <button onClick={handleClickClose}>
                  <CloseIcon />
                </button>
              </>
            }
          >
            Settings
          </Box.Header>
        }
      >
        {children}
      </Box>
    </div>
  );
}
